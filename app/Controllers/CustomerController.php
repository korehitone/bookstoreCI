<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Customer;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerController extends BaseController
{
    protected $model;
    protected $cart;

    public function __construct()
    {
        $this->model = new Customer();
        $this->cart = new Cart();
        $this->helpers = ['form', 'url', 'uuid'];
    }

    public function index()
    {
        //
        session();

        $data = [
            'title'      => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('customer/login', $data);
    }

    public function register()
    {
        session();

        $data = [
            'title'      => 'Register',
            'validation' => \Config\Services::validation()
        ];

        return view('customer/register', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'username'      => 'required',
            'email'        => 'required|valid_email|is_unique[customer.email]',
            'password'     => 'required|min_length[6]|max_length[200]',
            'confpassword' => [
                'label' => 'confirm password',
                'rules' => 'matches[password]'
            ]
        ])) {
            return redirect()->to('register')->withInput()->with('errors', $this->validator->getErrors());
        }

        $name  = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');

        $password = password_hash(
            $this->request->getPost('password'),
            PASSWORD_DEFAULT
        );

        $uuid = generateUUID();
        $customer = [
            'uid' => $uuid,
            'username' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address
        ];

        $save = $this->model->save($customer);

        if ($save) {
            $this->cart->save(['customer_id' => $customer['uid']]);
            return redirect()->to('login');
        } else {
            session()->setFlashdata('error', 'Some problems occured, please try again.');
            return redirect()->back();
        }
    }

    public function auth()
    {
        $session = session();

        if (!$this->validate([
            'email'        => 'required|valid_email',
            'password'     => 'required|max_length[200]',
        ])) {
            return redirect()->to('login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $this->model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_uid' => $data['uid'],
                    'user_name' => $data['username'],
                    'user_email' => $data['email'],
                    'user_address' => $data['address'],
                    'logged_in' => TRUE,
                    'role' => 'customer'
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                // $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('login')->withInput()->with('errors', $this->validator->setError('password', 'password is not correct')->getErrors());
            }
        } else {
            // $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('login')->withInput()->with('errors', $this->validator->setError('email', 'email not found')->getErrors());
        }
    }

    public function profile()
    {
        $session = session();

        $data = [
            'title' => 'Profile',
            'user' => $session->get()
        ];

        return view('customer/profile', $data);
    }

    public function updateProfil()
    {

        $session = session();

        if (!$session->has('user_uid')) {
            return redirect()->to('login');
        }

        $uuid = $session->get('user_uid');
        $username = $this->request->getPost('editUsername');
        $email = $this->request->getPost('editEmail');
        $address = $this->request->getPost('editAddress');

        $user = [
            'username' => $username,
            'email' => $email,
            'address' => $address
        ];

        $update = $this->model->where('uid', $uuid)->set($user)->update();
        if ($update) {

            $ses_data = [
                'user_name' => $username,
                'user_email' => $email,
                'user_address' => $address,
            ];
            $session->set($ses_data);
            $session->setFlashdata('success', 'Profile has been updated successfully');

            return redirect()->to('profile');
        } else {
            $session->setFlashdata('error', 'Some problems occured, please try again.');
            return redirect()->to('profile');
        }
    }

    public function updatePassword()
    {
        $session = session();

        if (!$session->has('user_uid')) {
            return redirect()->to('login');
        }

        $user = $this->model->where('email', $session->get('user_email'))->first();
        $password = is_object($user) ? $user->password : $user['password'];

        if (!$this->validate([
            'currentPassword' =>
            [
                'label' => 'current password',
                'rules' => [
                    'required',
                    static function ($value, array $data, ?string &$error = null) use ($password): bool {
                        if (!password_verify($value, $password)) {
                            $error = 'The password is not correct';
                            return false;
                        }
                        return true;
                    }
                ]
            ],
            'newPassword' => [
                'label' => 'new password',
                'rules' => 'required|min_length[6]|max_length[200]'
            ],
            'confirmNewPassword' => [
                'label' => 'confirm new password',
                'rules' => 'required|matches[newPassword]',
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $uuid = $session->get('user_uid');
        $newPassword = password_hash(
            $this->request->getPost('newPassword'),
            PASSWORD_DEFAULT
        );

        $user = [
            'password' => $newPassword
        ];

        $update = $this->model->where('uid', $uuid)->set($user)->update();
        if ($update) {
            $session->setFlashdata('success', 'Password has been updated successfully');
            return redirect()->to('profile');
        } else {
            $session->setFlashdata('error', 'Some problems occured, please try again.');
            return redirect()->to('profile');
        }
    }

    public function delete()
    {
        $session = session();

        if (!$session->has('user_uid')) {
            return redirect()->to('login');
        }

        $user = $this->model->where('uid', $session->get('user_uid'));
        if (!$user) {
            return redirect()->to('login')->with('error', 'User not found.');
        }

        $delete = $this->model->where('uid', $session->get('user_uid'))->delete();
        if ($delete) {
            $session->destroy();
            return redirect()->to('login');
        } else {
            session()->setFlashdata('error', 'Some problems occured, please try again.');
            return redirect()->to('profile');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'You have been logged out.');
    }
}
