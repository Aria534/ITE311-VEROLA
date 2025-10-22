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
    public function login()
    {
        if ($this->request->getMethod() !== 'POST') {
            return view('auth/login');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'Invalid email or password.');
        }

        // Save session
        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'isLoggedIn' => true
        ]);

        // Redirect based on role
        switch ($user['role']) {
            case 'admin':
                return redirect()->to(base_url('admin/dashboard'));
            case 'teacher':
                return redirect()->to(base_url('teacher/dashboard'));
            case 'student':
                return redirect()->to(base_url('student/dashboard'));
            default:
                return redirect()->to(base_url('dashboard'));
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
    // General Dashboard
    // ======================
    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');

        switch ($role) {
            case 'admin':
                return redirect()->to('admin/dashboard');
            case 'teacher':
                return redirect()->to('teacher/dashboard');
            case 'student':
                return redirect()->to('student/dashboard');
            default:
                return redirect()->to('announcements');
        }
    }
}
