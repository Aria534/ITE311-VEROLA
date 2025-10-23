<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    protected $helpers = ['form', 'url'];

    /**
     * Show upload form and handle uploads
     */
    public function upload($course_id)
    {
        helper(['form', 'url']);
        $materialModel = new MaterialModel();

        // ✅ Step 1: Check for POST request
        if ($this->request->getMethod() === 'POST') {

            // ✅ Step 2: Load Validation Library
            $validation = \Config\Services::validation();

            // ✅ Step 3: Configure validation rules
            $validation->setRules([
                'material_file' => [
                    'label' => 'Material File',
                    'rules' => 'uploaded[material_file]'
                        . '|ext_in[material_file,pdf,doc,docx,ppt,pptx,zip,rar,txt,jpg,png,mp4]'
                        . '|max_size[material_file,10240]', // 10 MB
                    'errors' => [
                        'uploaded' => 'Please choose a file to upload.',
                        'ext_in'   => 'Only PDF, Word, PowerPoint, ZIP, RAR, TXT, image, or MP4 files are allowed.',
                        'max_size' => 'The file size must not exceed 10MB.',
                    ]
                ]
            ]);

            // ✅ Validate
            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()
                    ->with('error', implode('<br>', $validation->getErrors()))
                    ->withInput();
            }

            // ✅ Step 4: Perform file upload
            $file = $this->request->getFile('material_file');

            if ($file->isValid() && !$file->hasMoved()) {
                // Make sure directory exists
                $uploadPath = FCPATH . 'uploads/materials/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Move file
                $newName = $file->getRandomName();
                $file->move($uploadPath, $newName);

                // ✅ Prepare data for DB
                $data = [
                    'course_id'   => $course_id,
                    'file_name'   => $file->getClientName(),
                    'file_path'   => 'uploads/materials/' . $newName,
                    'uploaded_by' => session()->get('user_id') ?? null,
                    'created_at'  => date('Y-m-d H:i:s'),
                ];

                // ✅ Save record to DB
                $materialModel->insert($data);

                // ✅ Step 5: Flash message + redirect
                return redirect()->to('/materials/upload/' . $course_id)
                    ->with('success', 'File uploaded successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to upload the file.');
            }
        }

        // ✅ Show upload form (GET request)
        return view('materials/upload', ['course_id' => $course_id]);
    }

    /**
     * ✅ Step 6: Display downloadable materials for students
     */
    public function list($course_id)
    {
        $materialModel = new MaterialModel();
        $materials = $materialModel->where('course_id', $course_id)->findAll();

        return view('materials/list', [
            'materials' => $materials,
            'course_id' => $course_id
        ]);
    }

    /**
     * Delete a material record and file
     */
    public function delete($material_id)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($material_id);

        if ($material) {
            $filePath = FCPATH . $material['file_path'];
            if (file_exists($filePath)) {
                unlink($filePath); // delete file
            }

            $materialModel->delete($material_id);
            return redirect()->back()->with('success', 'Material deleted successfully.');
        }

        return redirect()->back()->with('error', 'Material not found.');
    }

    /**
     * Download a material file
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
