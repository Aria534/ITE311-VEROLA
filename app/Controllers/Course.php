<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    protected $enrollmentModel;
    protected $courseModel;
    protected $session;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
        $this->courseModel = new CourseModel();
        $this->session = session();
        helper('url');
    }

    // Loads the student dashboard
    public function index()
    {
        $user_id = $this->session->get('user_id');
        $username = $this->session->get('username');
        $role = $this->session->get('role');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        // Get enrolled courses
        $enrolledCourses = $this->enrollmentModel->getUserEnrollments($user_id);

        // Get all courses
        $allCourses = $this->courseModel->findAll();

        // Available courses (exclude enrolled)
        $enrolledCourseIds = array_column($enrolledCourses, 'id');
        $availableCourses = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
            return !in_array($course['id'], $enrolledCourseIds);
        });

        $data = [
            'username' => $username,
            'role' => $role,
            'enrolledCourses' => $enrolledCourses,
            'availableCourses' => $availableCourses
        ];

        return view('authdashboard', $data);
    }

    // AJAX enrollment
    public function enroll()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)
                                  ->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $user_id = $this->session->get('user_id');
        if (!$user_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }

        $course_id = $this->request->getPost('course_id');
        $course_title = $this->request->getPost('course_title') ?? 'Course';

        if (!$course_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Course ID is required']);
        }

        if ($this->enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'You are already enrolled']);
        }

        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        if ($this->enrollmentModel->enrollUser($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enrollment successful',
                'course_title' => $course_title
            ]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enrollment failed']);
        }
    }
}
