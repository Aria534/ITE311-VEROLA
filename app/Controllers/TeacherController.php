<?php
namespace App\Controllers;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        if (session('role') !== 'teacher') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Teacher Dashboard',
            'courses' => ['Math 101', 'Science 201']
        ];

        return view('teacher/dashboard', $data);
    }
}
