<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use Config\Database;

class Auth extends Controller
{
    protected $session;
    protected $validation;
    protected $db;

    public function __construct()
    {
        $this->session    = Services::session();
        $this->validation = Services::validation();
        $this->db         = Database::connect();
    }

    // Register
    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'name'             => 'required|min_length[3]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'name'       => $this->request->getPost('name'),
                    'email'      => $this->request->getPost('email'),
                    'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role'       => $this->request->getPost('role') ?? 'user',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->db->table('users')->insert($data);

                $this->session->setFlashdata('success', 'Registration successful! Please log in.');
                return redirect()->to(base_url('login'));
            }

            $this->session->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        return view('auth/register');
    }

    // Login
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $this->db->table('users')->where('email', $email)->get()->getRowArray();

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set([
                    'userID'     => $user['id'],
                    'name'       => $user['name'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to(base_url('dashboard'));
            }

            $this->session->setFlashdata('login_error', 'Invalid email or password.');
            return redirect()->back()->withInput();
        }

        return view('auth/login');
    }

    // Logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }

    // Dashboard
    public function dashboard()
    {
        if (! $this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        return view('auth/dashboard', [
            'user' => [
                'name'  => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role'  => $this->session->get('role')
            ]
        ]);
    }
}
