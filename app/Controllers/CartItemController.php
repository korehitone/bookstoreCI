<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ViewCartItem;
use CodeIgniter\HTTP\ResponseInterface;

class CartItemController extends BaseController
{
    protected $model;
    protected $viewModel;
    protected $bookModel;
    protected $cartModel;

    public function __construct()
    {
        $this->model = new CartItem();
        $this->viewModel = new ViewCartItem();
        $this->bookModel = new Book();
        $this->cartModel = new Cart();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        //
    }

    public function add()
    {
        if (!$this->validate([
            'book_id' => 'required|is_natural_no_zero',
            'quantity' => 'required|is_natural_no_zero|less_than_equal_to[100]'
        ])) {
            return redirect()->back()->with('error', 'Invalid quantity');
        }

        $bookId = $this->request->getPost('book_id');
        $quantity = $this->request->getPost('quantity');
        $customerId = session()->get('user_uid');

        $book = $this->bookModel->find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found');
        }

        $cart = $this->cartModel->where('customer_id', $customerId)->first();
        
        if (!$cart) {
            return redirect()->back()->with('error', 'Cart not found');
        }

        $this->model->insert([
            'cart_id' => $cart['id'],
            'book_id' => $bookId,
            'quantity' => $quantity
        ]);
        
        return redirect()->to('cart')->with('success', 'Item added to cart successfully');
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
