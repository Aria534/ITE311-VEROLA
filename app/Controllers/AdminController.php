<?php
namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        if (session('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => 50, // Example data
            'totalCourses' => 12
        ];

        return view('admin/dashboard', $data);
    }
}
