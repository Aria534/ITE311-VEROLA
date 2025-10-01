<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => $this->request->getPost('role') ?? 'student',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Registration successful! Please log in.');
    }

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
            return redirect()->back()->withInput()->with('login_error', 'Invalid email or password.');
        }

        // Save session
        $sessionData = [
            'userID'     => $user['id'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'isLoggedIn' => true
        ];
        session()->set($sessionData);

        return redirect()->to(base_url('dashboard'));
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
    // Centralized Dashboard
    // ======================
    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $role = session()->get('role');

        $data = [
            'role'     => $role,
            'username' => session()->get('username')
        ];

        if ($role === 'admin') {
            $data['totalUsers'] = $this->userModel->countAll();
        }

        return view('auth/dashboard', $data);
    }
}
