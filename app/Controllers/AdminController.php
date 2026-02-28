<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Admin();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        //
    }

    public function save(){
        
    }
}
