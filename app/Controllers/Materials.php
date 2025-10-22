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
    }

    // Show upload page (teacher)
    public function upload()
    {
        return view('materials/upload');
    }

    // Handle actual upload
    public function do_upload()
    {
        $file = $this->request->getFile('file');
        $title = $this->request->getPost('title');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/materials', $newName);

            $this->materialModel->save([
                'title' => $title,
                'filename' => $newName,
                'filepath' => 'uploads/materials/' . $newName,
                'uploaded_by' => session()->get('username') ?? 'Teacher',
            ]);

            return redirect()->back()->with('success', 'Material uploaded successfully!');
        }

        return redirect()->back()->with('error', 'Failed to upload file.');
    }

    // Show all uploaded materials (student)
    public function list()
    {
        $materials = $this->materialModel->orderBy('created_at', 'DESC')->findAll();
        return view('materials/list', ['materials' => $materials]);
    }
}
