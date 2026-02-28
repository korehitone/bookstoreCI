<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\ViewCart;
use App\Models\ViewCartItem;
use CodeIgniter\HTTP\ResponseInterface;

class CartController extends BaseController
{
    protected $model;
    protected $viewModel;
    protected $itemModel;

    public function __construct()
    {
        $this->model = new Cart();
        $this->viewModel = new ViewCart();
        $this->itemModel = new ViewCartItem();
        $this->helpers = ['form', 'url'];
    }

    public function index()
    {
        //

        $session = session();

        $uuid = $session->get('user_uid');
        $cart = $this->viewModel->where('customer_id', $uuid)->first();
        $cartItem = $cart ? $this->itemModel->where('cart_id', $cart->id ?? $cart['id'])->orderBy('created_at', 'asc')->paginate(10) : [];

        $data = [
            'title' => 'Cart',
            'username' => $session->get('user_name'),
            'cart' => $cart,
            'cartItem' => $cartItem
        ];

        return view('customer/cart', $data);
    }

    public function getSummary()
    {

        $session = session();

        $uuid = $session->get('user_uid');
        $cart = $this->viewModel->where('customer_id', $uuid)->first();

        return $this->response->setJSON([
            'success' => true,
            'total_item' => $cart['total_item'],
            'total' => $cart['total']
        ]);
    }
}
