<?php

Namespace App\Controllers;

Use App\Models\EnrollmentModel;
Use CodeIgniter\Controller;

class Course extends BaseController
{
    protected $enrollmentModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->session = session();
        $this->enrollmentModel = new EnrollmentModel();
    }

    /**
     * Handles AJAX enrollment requests.
     * URL: POST /course/enroll
     */
    public function enroll()
    {
        // Ensure it's an AJAX POST request
        if (!$this->request->isAJAX()) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Invalid request type.',
                ]);
        }

        // Check if user is logged in
        $user_id = $this->session->get('user_id');
        if (empty($user_id)) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Please log in first.',
                ]);
        }

        // Get course_id from POST data
        $course_id = $this->request->getPost('course_id');
        if (empty($course_id)) {
            return $this->response
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Missing course ID.',
                ]);
        }

        // Prevent duplicate enrollment
        if ($this->enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'You are already enrolled in this course.',
                ]);
        }

        // Prepare enrollment data
        $data = [
            'user_id'         => $user_id,
            'course_id'       => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s'),
        ];

        // Insert record
        $insertId = $this->enrollmentModel->enrollUser($data);

        if ($insertId) {
            return $this->response
                ->setJSON([
                    'status'  => 'success',
                    'message' => 'Enrolled successfully.',
                    'enrollment' => array_merge(['id' => $insertId], $data),
                ]);
        }

        // Default error
        return $this->response
            ->setStatusCode(500)
            ->setJSON([
                'status'  => 'error',
                'message' => 'Failed to enroll. Please try again later.',
            ]);
    }
}
