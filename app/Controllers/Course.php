<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\NotificationModel;

class Course extends BaseController
{
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
        helper(['url', 'form']);
        // ❌ Removed $this->session from constructor to avoid ini_set() error
    }

    // ===============================
    // Enroll in a course (AJAX)
    // ===============================
    public function enroll()
    {
        // ✅ Initialize session safely
        $session = \Config\Services::session();
        if (is_callable([$session, 'isStarted'])) {
            if (! $session->isStarted()) {
                $session->start();
            }
        } else {
            if (method_exists($session, 'start')) {
                try {
                    $session->start();
                } catch (\Exception $e) {
                    log_message('error', 'Session start failed in Course::enroll - ' . $e->getMessage());
                }
            }
        }

        // ✅ Allow only AJAX or POST requests
        if (!$this->request->isAJAX() && $this->request->getMethod() !== 'POST') {
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid request type.'
                ]);
        }

        // ✅ Ensure user is logged in
        $userId = $session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'You must be logged in to enroll.'
                ]);
        }

        // ✅ Get the course ID
        $courseId = $this->request->getPost('course_id');
        if (empty($courseId)) {
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Course ID is required.'
                ]);
        }

        // ✅ Validate if the course exists
        $course = $this->courseModel->find($courseId);
        if (!$course) {
            return $this->response->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Course not found.'
                ]);
        }

        // ✅ Check if already enrolled
        $exists = $this->enrollmentModel
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($exists) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You are already enrolled in "' . $course['course_name'] . '".'
            ]);
        }

        // ✅ Enroll user
        $this->enrollmentModel->insert([
            'user_id' => $userId,
            'course_id' => $courseId,
            'enrolled_at' => date('Y-m-d H:i:s')
        ]);

        // ✅ Create notification
        $notificationModel = new NotificationModel();
        $notificationModel->insert([
            'user_id' => $userId,
            'message' => 'You have successfully enrolled in "' . esc($course['course_name']) . '".',
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // ✅ Response
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Enrollment successful! You have been enrolled in "' . $course['course_name'] . '".',
            'course_name' => $course['course_name']
        ]);
    }


    // ===============================
    // SEARCH COURSES
    // ===============================
 public function search()
{
    $searchTerm = $this->request->getGet('search_term');

    if (!empty($searchTerm)) {
        $this->courseModel->like('course_name', $searchTerm);
        $this->courseModel->orLike('description', $searchTerm);
    }

    $courses = $this->courseModel->findAll();

    if ($this->request->isAJAX()) {
        return $this->response->setJSON($courses);
    }

    return view('templates/header')
        . view('course/index', [
            'courses' => $courses,
            'searchTerm' => $searchTerm
        ]);
}
}

