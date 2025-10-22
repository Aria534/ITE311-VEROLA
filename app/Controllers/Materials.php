<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Materials extends Controller
{
    public function upload($courseId)
    {
        helper(['form', 'url']);
        $materialModel = new MaterialModel();

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material_file');

            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Rename and move file to uploads folder
                $newName = $file->getRandomName();
                $file->move('uploads/materials', $newName);

                // Prepare data for database
                $data = [
                    'course_id' => $courseId,
                    'file_name' => $file->getClientName(),
                    'file_path' => 'uploads/materials/' . $newName,
                ];

                // Insert into database
                $materialModel->insertMaterial($data);

                return redirect()->to('/dashboard')->with('success', 'Material uploaded successfully!');
            } else {
                return redirect()->back()->with('error', 'Upload failed. Please try again.');
            }
        }

        return view('materials/upload_form'); // if you have a view form
    }
}
    public function delete($materialId)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($materialId);

        if ($material) {
            // Delete the file from the server
            if (file_exists($material['file_path'])) {
                unlink($material['file_path']);
            }

            // Delete the record from the database
            $materialModel->delete($materialId);

            return redirect()->to('/dashboard')->with('success', 'Material deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Material not found.');
        }
    }

    public function download($materialId)
    {
        $materialModel = new MaterialModel();
        $material = $materialModel->find($materialId);

        if ($material && file_exists($material['file_path'])) {
            return $this->response->download($material['file_path'], null);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}