<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use CodeIgniter\HTTP\Response;

class Course extends BaseController
{
    protected $courseModel;
    protected $enrollmentModel;
    protected $session;

    public function __construct()
    {
        helper(['url', 'security']);
        $this->session = session();
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    /**
     * AJAX handler to enroll the logged in user in a course
     */
    public function enroll()
    {
        // Only accept POST requests
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405)->setJSON(['status' => 'error', 'message' => 'Method not allowed']);
        }

        // Check login (use session user_id)
        $user_id = $this->session->get('user_id');
        if (empty($user_id)) {
            return $this->response->setStatusCode(401)->setJSON(['status' => 'error', 'message' => 'Unauthorized']);
        }

        // Validate course_id
        $course_id = $this->request->getPost('course_id');
        if (!is_numeric($course_id)) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Invalid course id']);
        }
        $course_id = (int)$course_id;

        // Check course exists
        $course = $this->courseModel->find($course_id);
        if (!$course) {
            return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Course not found']);
        }

        // Prevent duplicate enrollment
        if ($this->enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setStatusCode(409)->setJSON(['status' => 'error', 'message' => 'Already enrolled']);
        }

        // Insert enrollment
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s'),
        ];

        $insertId = $this->enrollmentModel->enrollUser($data);

        if ($insertId === false) {
            return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Failed to enroll']);
        }

        // Return success + optionally return inserted row or updated enrolled list
        // Also provide a fresh CSRF hash for AJAX client to update (if CSRF is enabled)
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Enrolled successfully',
            'enrollment' => [
                'id' => $insertId,
                'course_id' => $course_id,
                'course_name' => $course['course_name'] ?? null,
                'enrollment_date' => date('Y-m-d H:i:s'),
            ],
            'csrfHash' => csrf_hash() // client can update token after each AJAX response
        ]);
    }

    // Optional: serve available courses page
    public function index()
    {
        $data['courses'] = $this->courseModel->findAll();
        echo view('dashboard', $data);
    }
}
