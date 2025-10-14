<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Course extends BaseController
{
    protected $courseModel;
    protected $enrollmentModel;
    protected $session;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->session = session();
        helper(['url', 'form']);
    }

    // ===============================
    // Enroll in a course (AJAX)
    // ===============================
    public function enroll()
    {
        // ✅ Allow only AJAX or POST requests
        if (! $this->request->isAJAX() && $this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid request type.'
                ]);
        }

        // ✅ Ensure user is logged in
        $userId = $this->session->get('user_id');
        if (! $userId) {
            return $this->response->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'You must be logged in to enroll.'
                ]);
        }

        // ✅ Get the course ID from POST
        $courseId = $this->request->getPost('course_id');
        if (empty($courseId)) {
            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Course ID is required.'
                ]);
        }

        // ✅ Validate if the course actually exists
        $course = $this->courseModel->find($courseId);
        if (! $course) {
            return $this->response->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Course not found.'
                ]);
        }

        // ✅ Check if the user is already enrolled
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

        // ✅ Enroll the user in the course
        $this->enrollmentModel->insert([
            'user_id' => $userId,
            'course_id' => $courseId,
            'enrolled_at' => date('Y-m-d H:i:s') // Optional: add timestamp
        ]);

        // ✅ Send success response
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Enrollment successful! You have been enrolled in "' . $course['course_name'] . '".',
            'course_name' => $course['course_name']
        ]);
    }
}
