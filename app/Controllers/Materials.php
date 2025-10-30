<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\EnrollmentModel;
use App\Models\NotificationModel;
use CodeIgniter\Controller;

class Materials extends BaseController
{
    protected $materialModel;
    protected $courseModel;
    protected $userModel;
    protected $enrollmentModel;
    protected $notificationModel;
    protected $session;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        $this->courseModel = new CourseModel();
        $this->userModel = new UserModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->notificationModel = new NotificationModel();
        $this->session = session();
    }

    // ✅ Display upload form
    public function upload($courseId)
    {
        $data['course'] = $this->courseModel->find($courseId);
        return view('materials/upload', $data);
    }

    // ✅ Handle upload form submission
    public function uploadMaterial($courseId)
    {
        $userId = $this->session->get('user_id');
        $role   = $this->session->get('role'); // e.g., 'teacher', 'admin'

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $file = $this->request->getFile('material_file');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Upload failed. Please try again.');
        }

        $newName = $file->getRandomName();
        $file->move('uploads/materials/', $newName);

        // Save record in DB
        $this->materialModel->insert([
            'course_id'   => $courseId,
            'uploaded_by' => $userId,
            'file_name'   => $file->getClientName(),
            'file_path'   => 'uploads/materials/' . $newName,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

       // =============================== 🔔 Send Notifications ===============================

// Get all students enrolled in this course
$students = $this->enrollmentModel
    ->select('users.id')
    ->join('users', 'users.id = enrollments.user_id')
    ->where('enrollments.course_id', $courseId)
    ->findAll();

foreach ($students as $student) {
    $this->notificationModel->insert([
        'user_id'   => $student['id'],
        'message'   => '📚 New material has been uploaded in "' . esc($course['course_name']) . '".',
        'is_read'   => 0,
        'created_at'=> date('Y-m-d H:i:s')
    ]);
}

// =====================================================================================

        return redirect()->back()->with('success', 'Material uploaded and notifications sent!');
    }

    // ✅ Download file
    public function download($id)
    {
        $material = $this->materialModel->find($id);
        if (!$material) {
            return redirect()->back()->with('error', 'File not found.');
        }
        return $this->response->download($material['file_path'], null);
    }

    // ✅ Delete file
    public function delete($id)
    {
        $this->materialModel->delete($id);
        return redirect()->back()->with('success', 'Material deleted successfully.');
    }
}
