<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Check if user is admin
     */
    private function checkAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Access denied. Admin privileges required.'
                ]);
            }
            return redirect()->to(base_url('login'))
                ->with('error', 'Access denied. Admin privileges required.');
        }
        return null;
    }

    /**
     * List all users
     */
    public function index()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        // Get users with their latest enrollment date
        $users = $this->userModel->select('users.*, MAX(enrollments.enrollment_date) as latest_enrollment_date')
            ->join('enrollments', 'enrollments.user_id = users.id', 'left')
            ->groupBy('users.id')
            ->orderBy('users.created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Manage Users',
            'users' => $users,
        ];

        return view('users/index', $data);
    }

    /**
     * Create a new user (GET - show form)
     */
    public function create()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }
        return view('users/create', ['title' => 'Create User']);
    }

    /**
     * Store a new user (POST)
     */
    public function store()
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        $rules = [
            'username'         => 'required|min_length[3]|is_unique[users.username]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'role'             => 'required|in_list[student,teacher,admin]',
            'status'           => 'required|in_list[active,inactive]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'       => $this->request->getPost('role'),
            'status'     => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('users'))
            ->with('success', 'User created successfully!');
    }

    /**
     * Edit user (GET - show form)
     */
    public function edit($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))
                ->with('error', 'User not found.');
        }

        $data = [
            'title' => 'Edit User',
            'user'  => $user
        ];

        return view('users/edit', $data);
    }

    /**
     * Update user (POST)
     */
    public function update($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))
                ->with('error', 'User not found.');
        }

        $rules = [
            'username' => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'role'     => 'required|in_list[student,teacher,admin]',
            'status'   => 'required|in_list[active,inactive]'
        ];

        // Check if username is unique (excluding current user)
        $existingUser = $this->userModel->where('username', $this->request->getPost('username'))
            ->where('id !=', $id)
            ->first();
        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['username' => 'Username already exists.']);
        }

        // Check if email is unique (excluding current user)
        $existingEmail = $this->userModel->where('email', $this->request->getPost('email'))
            ->where('id !=', $id)
            ->first();
        if ($existingEmail) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['email' => 'Email already exists.']);
        }

        // Password is optional on update
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'role'       => $this->request->getPost('role'),
            'status'     => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Only update password if provided
        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to(base_url('users'))
            ->with('success', 'User updated successfully!');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        // Prevent toggling your own status
        if ($id == session()->get('user_id')) {
            return redirect()->to(base_url('users'))
                ->with('error', 'You cannot change your own status.');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))
                ->with('error', 'User not found.');
        }

        $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';

        $this->userModel->update($id, [
            'status' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $statusText = ucfirst($newStatus);
        return redirect()->to(base_url('users'))
            ->with('success', "User status changed to {$statusText} successfully!");
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        $adminCheck = $this->checkAdmin();
        if ($adminCheck !== null) {
            return $adminCheck;
        }

        // Prevent deleting yourself
        if ($id == session()->get('user_id')) {
            return redirect()->to(base_url('users'))
                ->with('error', 'You cannot delete your own account.');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to(base_url('users'))
                ->with('error', 'User not found.');
        }

        $this->userModel->delete($id);

        return redirect()->to(base_url('users'))
            ->with('success', 'User deleted successfully!');
    }
}

