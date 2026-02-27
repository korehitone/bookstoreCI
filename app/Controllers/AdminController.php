<?php

namespace App\Controllers;

use App\Models\Admin;
use CodeIgniter\Controller;

class AdminController extends BaseController
{
    protected Admin $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    // -----------------------------------------------------------------------
    // AUTH GUARD
    // -----------------------------------------------------------------------

    private function requireLogin(): mixed
    {
        if (!session()->get('isLoggedIn') || !session()->get('isAdmin')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        return null;
    }

    // -----------------------------------------------------------------------
    // REGISTRATION
    // -----------------------------------------------------------------------

    public function register(): string
    {
        return view('users/signupAdmin');
    }

    public function attemptRegister(): mixed
    {
        $rules = [
            'username'         => 'required|min_length[4]|max_length[50]|is_unique[admin.username]',
            'email'            => 'required|valid_email|max_length[64]|is_unique[admin.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        $messages = [
            'username'         => ['is_unique' => 'That username is already taken.'],
            'email'            => ['is_unique' => 'An account with that email already exists.'],
            'confirm_password' => ['matches'   => 'Passwords do not match.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->adminModel->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
    }

    // -----------------------------------------------------------------------
    // LOGIN / LOGOUT
    // -----------------------------------------------------------------------

    public function login(): mixed
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/books');
        }

        return view('users/login');
    }

    public function attemptLogin(): mixed
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $admin = $this->adminModel
            ->where('username', $this->request->getPost('username'))
            ->first();

        if (!$admin || !password_verify($this->request->getPost('password'), $admin['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->set([
            'admin_id'   => $admin['id'],
            'username'   => $admin['username'],
            'isLoggedIn' => true,
            'isAdmin'    => true,
        ]);

        return redirect()->to('/admin/books');
    }

    public function logout(): mixed
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }

    // -----------------------------------------------------------------------
    // PROFILE
    // -----------------------------------------------------------------------

    public function show(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        return view('users/profileAdmin', [
            'title' => 'Admin Profile',
            'admin' => $this->adminModel->find(session()->get('admin_id')),
        ]);
    }

    public function editProfile(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        return view('users/editProfile', [
            'title' => 'Edit Profile',
            'admin' => $this->adminModel->find(session()->get('admin_id')),
        ]);
    }

    public function updateProfile(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $id = session()->get('admin_id');

        $rules = [
            'username' => "required|min_length[4]|max_length[50]|is_unique[admin.username,id,{$id}]",
            'email'    => "required|valid_email|max_length[64]|is_unique[admin.email,id,{$id}]",
        ];

        $messages = [
            'username' => ['is_unique' => 'That username is already taken.'],
            'email'    => ['is_unique' => 'That email is already in use by another account.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        $this->adminModel->update($id, $data);
        session()->set('username', $data['username']);

        return redirect()->to('/admin/profile')->with('success', 'Profile updated successfully!');
    }

    public function deleteProfile(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $id = session()->get('admin_id');

        if (!$id) {
            return redirect()->to('/login')->with('error', 'Invalid admin ID.');
        }

        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return redirect()->to('/login')->with('error', 'Admin not found.');
        }

        // Delete the admin account
        $this->adminModel->delete($id);

        // Destroy session
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Your account has been deleted successfully.');
    }

    // -----------------------------------------------------------------------
    // FORGOT / RESET PASSWORD
    // -----------------------------------------------------------------------

    public function forgotPassword(): string
    {
        return view('users/forgotPass');
    }

    public function resetPassword(): mixed
    {
        $rules = [
            'email'            => 'required|valid_email|max_length[64]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        $messages = [
            'confirm_password' => ['matches' => 'Passwords do not match.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $admin = $this->adminModel
            ->where('email', $this->request->getPost('email'))
            ->first();

        if (!$admin) {
            return redirect()->to('/login')->with('success', 'If that email exists, the password has been reset.');
        }

        $this->adminModel->update($admin['id'], [
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->to('/login')->with('success', 'Password reset successfully. Please login.');
    }
}