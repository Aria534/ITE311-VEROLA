<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\EnrollmentModel;
use App\Models\NotificationModel;

class Materials extends BaseController
{
    protected $materialModel;
    protected $courseModel;
    protected $userModel;
    protected $enrollmentModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->materialModel     = new MaterialModel();
        $this->courseModel       = new CourseModel();
        $this->userModel         = new UserModel();
        $this->enrollmentModel   = new EnrollmentModel();
        $this->notificationModel = new NotificationModel();

        helper(['url', 'form']);
    }

    // ====================== SHOW UPLOAD PAGE (GET) ==========================
    public function upload($courseId)
    {
        $session = session();

        // GET REQUEST → DISPLAY UPLOAD PAGE
        if ($this->request->getMethod() === 'GET') {

            $course = $this->courseModel->find($courseId);
            if (!$course) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Course not found');
            }

            $materials = $this->materialModel
                ->where('course_id', $courseId)
                ->orderBy('created_at', 'DESC')
                ->findAll();

            return view('materials/upload', [
                'course_id' => $courseId,
                'course'    => $course,
                'materials' => $materials,
            ]);
        }

        // POST REQUEST → PROCESS UPLOAD
        if ($this->request->getMethod() === 'POST') {

            if (!$session->get('user_id')) {
                return redirect()->to('/login')->with('error', 'Please log in first.');
            }

            $userId = $session->get('user_id');
            $course = $this->courseModel->find($courseId);

            if (!$course) {
                return redirect()->back()->with('error', 'Course not found.');
            }

            $files = $this->request->getFileMultiple('material_file');

            if (!$files) {
                return redirect()->back()->with('error', 'No files selected.');
            }

            $uploadPath = ROOTPATH . 'public/uploads/materials/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $allowed = ['pdf','doc','docx','ppt','pptx','zip','rar','txt','jpg','png','mp4'];

            foreach ($files as $file) {
                if (!$file->isValid()) continue;

                $ext = strtolower($file->getExtension());
                if (!in_array($ext, $allowed)) {
                    return redirect()->back()->with('error', 'File not allowed: ' . $file->getClientName());
                }

                if ($file->getSize() > 10 * 1024 * 1024) {
                    return redirect()->back()->with('error', 'File too large: ' . $file->getClientName());
                }

                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                $this->materialModel->insert([
                    'course_id'   => $courseId,
                    'uploaded_by' => $userId,
                    'file_name'   => $file->getClientName(),
                    'file_path'   => 'uploads/materials/' . $newName,
                    'created_at'  => date('Y-m-d H:i:s')
                ]);
            }
//Edited
            return redirect()->back()->with('success', 'Materials uploaded successfully!');
        }

        // Fallback for other request methods
        return redirect()->to('/dashboard')->with('error', 'Invalid request method.');
    }

    // ====================== DOWNLOAD ==========================
    public function download($id)
    {
        $material = $this->materialModel->find($id);
        if (!$material) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $filePath = ROOTPATH . 'public/' . $material['file_path'];
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File missing on server.');
        }

        return $this->response->download($filePath, null);
    }

    // ====================== DELETE ==========================
    public function delete($id)
    {
        $material = $this->materialModel->find($id);
        if ($material) {
            $filePath = ROOTPATH . 'public/' . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->materialModel->delete($id);
        }

        return redirect()->back()->with('success', 'Material deleted successfully.');
    }
}
