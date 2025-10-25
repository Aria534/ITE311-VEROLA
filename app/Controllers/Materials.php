<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\CourseModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    protected $db;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        // Connect to the database
        $this->db = \Config\Database::connect();
    }

    /**
     * Upload Form + Handle Uploads
     */
    public function upload($course_id)
    {
        helper(['form', 'url']);
        $materialModel = new MaterialModel();

        if ($this->request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'material_title' => [
                    'label' => 'Material Title',
                    'rules' => 'required|max_length[255]',
                    'errors' => [
                        'required'   => 'Material title is required.',
                        'max_length' => 'Material title must not exceed 255 characters.'
                    ]
                ],
                'material_file' => [
                    'label' => 'Material File',
                    'rules' => 'uploaded[material_file]'
                        . '|ext_in[material_file,pdf,doc,docx,ppt,pptx,zip,rar,txt,jpg,png,mp4]'
                        . '|max_size[material_file,10240]',
                    'errors' => [
                        'uploaded' => 'Please choose a file to upload.',
                        'ext_in'   => 'Only PDF, Word, PowerPoint, ZIP, RAR, TXT, image, or MP4 files are allowed.',
                        'max_size' => 'The file size must not exceed 10MB.',
                    ]
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()
                    ->with('error', implode('<br>', $validation->getErrors()))
                    ->withInput();
            }

            $file = $this->request->getFile('material_file');

            if ($file->isValid() && !$file->hasMoved()) {
                $uploadPath = FCPATH . 'uploads/materials/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                // Save uploaded file info to database
                $data = [
                    'course_id'     => $course_id,
                    'material_title'=> $this->request->getPost('material_title'),
                    'file_name'     => $file->getClientName(),
                    'file_path'     => 'uploads/materials/' . $newName,
                    'uploaded_by'   => session()->get('username') ?? 'Admin',
                    'created_at'    => date('Y-m-d H:i:s'),
                ];

                $materialModel->insert($data);

                return redirect()->to('/admin/course/' . $course_id . '/upload')
                    ->with('success', 'File uploaded successfully and saved to database!');
            } else {
                return redirect()->back()->with('error', 'File upload failed.');
            }
        }

        // Fetch course info and materials
        $courseModel = new CourseModel();
        $course = $courseModel->find($course_id);
        $materials = $materialModel->where('course_id', $course_id)->findAll();

        // Display upload page
        return view('materials/upload', [
            'course' => $course,
            'materials' => $materials,
            'course_id' => $course_id
        ]);
    }

    /**
     * Delete a material (from DB + file)
     */
    public function delete($material_id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = FCPATH . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $materialModel->delete($material_id);
            return redirect()->back()->with('success', 'Material deleted successfully.');
        }

        return redirect()->back()->with('error', 'Material not found.');
    }

    /**
     * Download Material
     */
    public function download($material_id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = FCPATH . $material['file_path'];
            if (file_exists($filePath)) {
                return $this->response->download($filePath, null);
            }
        }

        return redirect()->back()->with('error', 'File not found.');
    }
}
