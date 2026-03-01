<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminLog;
use CodeIgniter\HTTP\ResponseInterface;

class AdminLogController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AdminLog();
    }

    public function index()
    {
        //
        $keyword = $this->request->getGet('keyword');
        $order = $this->request->getGet('order') ?? 'DESC';

        $order = ($order === 'ASC') ? 'ASC' : 'DESC';

        $this->model->orderBy('created_at', $order);

        if ($keyword) {
            $this->model
                ->groupStart()
                ->like('username', $keyword)
                ->orLike('email', $keyword)
                ->orLike('action', $keyword)
                ->orLike('table_name', $keyword)
                ->orLike('details', $keyword)
                ->groupEnd();
        }

        return view('admin/logs', [
            'title'   => 'Activity Logs',
            'logs'    => $this->model->paginate(15),
            'pager'   => $this->model->pager,
            'keyword' => $keyword,
            'order'   => $order,
        ]);
    }
}
