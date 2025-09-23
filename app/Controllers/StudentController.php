<?php
namespace App\Controllers;

class StudentController extends BaseController
{
    public function dashboard()
    {
        if (session('role') !== 'student') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Student Dashboard',
            'enrolledCourses' => ['Math 101', 'History 202'],
            'upcomingDeadlines' => ['Sept 30: Assignment 1']
        ];

        return view('student/dashboard', $data);
    }
}
