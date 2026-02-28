<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartItem;
use App\Models\ViewCartItem;
use CodeIgniter\HTTP\ResponseInterface;

class CartItemController extends BaseController
{
    protected $model;
    protected $viewModel;

    public function __construct()
    {
        $this->model = new CartItem();
        $this->viewModel = new ViewCartItem();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        //
    }

    public function update()
    {
        try {
            $data = $this->request->getJSON();

            if (!$data || !isset($data->item_id) || !isset($data->quantity)) {
                return $this->response->setJSON(['success' => false]);
            }

            $item = $this->model->find($data->item_id);
            if (!$item) {
                return  redirect()->to('cart');
            }

            $update = $this->model->update($data->item_id, ['quantity' => $data->quantity]);

            if ($update) {

                $total = $this->viewModel->find($item['id']);
                return $this->response->setJSON([
                    'success' => true,
                    'new_price' => $total['total_price']
                ]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function delete()
    {
        $data = $this->request->getJSON();

        if (!$data || !isset($data->item_id)) {
            return $this->response->setJSON(['success' => false]);
        }

        $delete = $this->model->delete($data->item_id);

        if ($delete) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function deleteSelected()
    {
        $data = $this->request->getJSON();

        if (!$data || !isset($data->item_ids) || !is_array($data->item_ids)) {
            return $this->response->setJSON(['success' => false]);
        }

        $delete = $this->model->whereIn('id', $data->item_ids)->delete();

        if ($delete) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
