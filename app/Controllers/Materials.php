<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    public function index()
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        $data = [
            'username' => $session->get('username'),
            'role' => $role,
        ];

        $materialModel = new MaterialModel();
        $courseModel   = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        if ($role === 'student') {
            // Fetch enrolled courses
            $enrolledCourses = $enrollmentModel
                ->select('courses.id, courses.course_name')
                ->join('courses', 'enrollments.course_id = courses.id')
                ->where('user_id', $userId)
                ->findAll();

            $data['enrolledCourses'] = $enrolledCourses;

            $courseIds = array_column($enrolledCourses, 'id');

            // Fetch materials for these courses
            if (!empty($courseIds)) {
                $materials = $materialModel->whereIn('course_id', $courseIds)->findAll();
            } else {
                $materials = [];
            }

            $data['materials'] = $materials;

        } elseif ($role === 'teacher') {
            // Fetch teacher courses
            $courses = $courseModel->where('teacher_id', $userId)->findAll();
            $data['courses'] = $courses;

            $courseIds = array_column($courses, 'id');

            if (!empty($courseIds)) {
                $materials = $materialModel->whereIn('course_id', $courseIds)->findAll();
            } else {
                $materials = [];
            }

            $data['materials'] = $materials;
        }

        return view('auth/dashboard', $data);
    }

    public function upload($course_id)
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        // Check if user is teacher
        if ($role !== 'teacher') {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }

        // Check if course belongs to teacher
        $courseModel = new CourseModel();
        $course = $courseModel->where('id', $course_id)->where('teacher_id', $userId)->first();
        if (!$course) {
            return redirect()->to('/dashboard')->with('error', 'Course not found or access denied.');
        }

        if ($this->request->getMethod() === 'POST') {
            // Load helpers
            helper(['form', 'url']);

            // Validation rules
            $validation = \Config\Services::validation();
            $validation->setRules([
                'material' => [
                    'label' => 'Material File',
                    'rules' => 'uploaded[material]|max_size[material,10240]|ext_in[material,pdf,doc,docx,ppt,pptx]',
                ],
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('error', $validation->getErrors());
            }

            // Upload configuration
            $upload = \Config\Services::upload();
            $upload->initialize([
                'upload_path' => WRITEPATH . 'uploads/',
                'allowed_types' => 'pdf|doc|docx|ppt|pptx',
                'max_size' => 10240, // 10MB
                'encrypt_name' => true,
            ]);

            if (!$upload->do_upload('material')) {
                return redirect()->back()->withInput()->with('error', $upload->display_errors());
            }

            $uploadData = $upload->data();
            $fileName = $uploadData['file_name'];
            $filePath = WRITEPATH . 'uploads/' . $fileName;

            // Save to database
            $materialModel = new MaterialModel();
            $data = [
                'course_id' => $course_id,
                'file_name' => $this->request->getPost('title'),
                'file_path' => $filePath,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            if ($materialModel->insertMaterial($data)) {
                return redirect()->to('/dashboard')->with('success', 'Material uploaded successfully.');
            } else {
                // Delete uploaded file if DB insert fails
                unlink($filePath);
                return redirect()->back()->withInput()->with('error', 'Failed to save material.');
            }
        }

        // Display upload form
        $data = [
            'course_id' => $course_id,
            'course_name' => $course['course_name'],
        ];
        return view('materials/upload_form', $data);
    }

    public function delete($material_id)
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        if ($role !== 'teacher') {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }

        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if (!$material) {
            return redirect()->to('/dashboard')->with('error', 'Material not found.');
        }

        // Check if teacher owns the course
        $courseModel = new CourseModel();
        $course = $courseModel->where('id', $material['course_id'])->where('teacher_id', $userId)->first();
        if (!$course) {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }

        // Delete file from server
        if (file_exists($material['file_path'])) {
            unlink($material['file_path']);
        }

        // Delete from database
        if ($materialModel->delete($material_id)) {
            return redirect()->to('/dashboard')->with('success', 'Material deleted successfully.');
        } else {
            return redirect()->to('/dashboard')->with('error', 'Failed to delete material.');
        }
    }

    public function download($material_id)
    {
        $session = session();
        $role = $session->get('role');
        $userId = $session->get('user_id');

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in to download materials.');
        }

        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if (!$material) {
            return redirect()->to('/dashboard')->with('error', 'Material not found.');
        }

        // Check if user is enrolled in the course
        $enrollmentModel = new EnrollmentModel();
        $enrolled = $enrollmentModel->where('user_id', $userId)->where('course_id', $material['course_id'])->first();

        if (!$enrolled && $role !== 'teacher') {
            return redirect()->to('/dashboard')->with('error', 'You are not enrolled in this course.');
        }

        // Check if file exists
        if (!file_exists($material['file_path'])) {
            return redirect()->to('/dashboard')->with('error', 'File not found on server.');
        }

        // Force download
        return $this->response->download($material['file_path'], null, true)->setFileName($material['file_name']);
    }
}
