<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Materials extends BaseController
{
    protected $materialModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        helper(['form', 'url', 'filesystem']);
    }

    // Upload materials
    public function upload($course_id)
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/materials', $newName);

                $data = [
                    'course_id' => $course_id,
                    'file_name' => $file->getClientName(),
                    'file_path' => 'uploads/materials/' . $newName,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $this->materialModel->insertMaterial($data);

                return redirect()->back()->with('success', 'File uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to upload file.');
            }
        }

        return view('materials/upload', ['course_id' => $course_id]);
    }

    // Delete material
    public function delete($id)
    {
        $material = $this->materialModel->find($id);
        if ($material) {
            if (is_file($material['file_path'])) {
                unlink($material['file_path']);
            }
            $this->materialModel->delete($id);
            return redirect()->back()->with('success', 'Material deleted successfully.');
        }

        return redirect()->back()->with('error', 'Material not found.');
    }

    // Download material
    public function download($id)
    {
        $material = $this->materialModel->find($id);
        if (!$material) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return $this->response->download($material['file_path'], null);
    }
}
