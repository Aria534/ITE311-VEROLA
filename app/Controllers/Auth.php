<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    // ======================
    // Register
    // ======================
    public function register()
    {
        if ($this->request->getMethod() !== 'POST') {
            return view('auth/register');
        }

        $rules = [
            'username'         => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => $this->request->getPost('role') ?? 'student',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('login'))
                         ->with('success', 'Registration successful! Please log in.');
    }

    // ======================
    // Login
    // ======================
   // ======================
// Login
// ======================
public function login()
{
    if ($this->request->getMethod() !== 'POST') {
        return view('auth/login');
    }

    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $this->userModel->where('email', $email)->first();

    if (! $user || ! password_verify($password, $user['password'])) {
        return redirect()->back()
                         ->withInput()
                         ->with('login_error', 'Invalid email or password.');
    }

    // ✅ Save session data
    $sessionData = [
        'user_id'    => $user['id'],
        'username'   => $user['username'],
        'email'      => $user['email'],
        'role'       => $user['role'],
        'isLoggedIn' => true
    ];
    session()->set($sessionData);

    // ✅ Redirect based on role
    switch ($user['role']) {
        case 'admin':
            return redirect()->to(base_url('admin/dashboard'));
        case 'teacher':
            return redirect()->to(base_url('teacher/dashboard'));
        default:
            return redirect()->to(base_url('announcements'));
    }
}

    // ======================
    // Logout
    // ======================
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    // ======================
    // Dashboard
    // ======================
    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');
        $userId = session()->get('user_id');

        $data = [
            'role'     => $role,
            'username' => session()->get('username'),
        ];

        if ($role === 'admin') {
            $data['totalUsers']       = $this->userModel->countAllResults();
            $data['totalCourses']     = $this->courseModel->countAllResults();
            $data['totalEnrollments'] = $this->enrollmentModel->countAllResults();
        } elseif ($role === 'student') {
            // ✅ Enrolled Courses
            $enrolledCourses = $this->enrollmentModel
                ->select('courses.id, courses.course_name, courses.description')
                ->join('courses', 'courses.id = enrollments.course_id')
                ->where('enrollments.user_id', $userId)
                ->findAll();

            // ✅ Exclude enrolled ones from available
            $enrolledIds = array_column($enrolledCourses, 'id');
            $availableCourses = $this->courseModel
                ->whereNotIn('id', $enrolledIds ?: [0])
                ->findAll();

            $data['enrolledCourses'] = $enrolledCourses;
            $data['availableCourses'] = $availableCourses;
        }

        return view('auth/dashboard', $data);
    }
}
