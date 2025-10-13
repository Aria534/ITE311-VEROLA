<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

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
        if (! $this->request->isAJAX() && $this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $userId = $this->session->get('user_id');
        $courseId = $this->request->getPost('course_id');

        // Check if already enrolled
        $exists = $this->enrollmentModel
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($exists) {
            return $this->response->setJSON(['success' => false, 'message' => 'Already enrolled in this course.']);
        }

        // Insert enrollment
        $this->enrollmentModel->insert([
            'user_id' => $userId,
            'course_id' => $courseId,
        ]);

        // Get course title for success message
        $course = $this->courseModel->find($courseId);

        return $this->response->setJSON([
            'success' => true,
            'course_title' => $course['course_name'] ?? 'Unknown Course',
        ]);
    }
}
