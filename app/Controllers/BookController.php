<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;

class BookController extends BaseController
{
    protected Book $bookModel;
    protected $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
        $this->bookModel = new Book();
        $this->db = \Config\Database::connect();
    }

    // -----------------------------------------------------------------------
    // PUBLIC — User Facing
    // -----------------------------------------------------------------------

    public function index(): string
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->bookModel
                ->groupStart()
                ->like('title', $keyword)
                ->orLike('author', $keyword)
                ->orLike('sipnosis', $keyword)
                ->groupEnd();
        }

        return view('customer/home', [
            'title'         => 'Our Book Collection',
            'books'         => $this->bookModel->paginate(12),
            'pager'         => $this->bookModel->pager,
            'keyword'       => $keyword,
            'navCategories' => $this->navCategories,
        ]);
    }

    public function details(int $id): string
    {
        $cartModel = new Cart();
        $cartItemModel = new CartItem();

        $book = $this->bookModel
            ->select('book.*, category.name AS category_name')
            ->join('category', 'category.id = book.category_id', 'left')
            ->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Book with ID {$id} not found."
            );
        }

        $customerId = session()->get('user_uid');
        $cart = $cartModel->where('customer_id', $customerId)->first();
        if ($cart) {
            $item = $cartItemModel
                ->where('cart_id', $cart['id'])
                ->where('book_id', $id)
                ->first();

            $inCart = !empty($item);
        } else {
            $inCart = false;
        }

        return view('customer/book', [
            'title' => 'Book Detail',
            'inCart' => $inCart,
            'book'          => $book,
            'navCategories' => $this->navCategories,
        ]);
    }

    // -----------------------------------------------------------------------
    // ADMIN — Protected
    // -----------------------------------------------------------------------

    public function admin_index(): string
    {
        $keyword = $this->request->getGet('keyword');

        $this->bookModel
            ->select('book.*, category.name AS category_name')
            ->join('category', 'category.id = book.category_id', 'left');

        if ($keyword) {
            $this->bookModel
                ->groupStart()
                ->like('book.title', $keyword)
                ->orLike('book.author', $keyword)
                ->groupEnd();
        }

        return view('admin/dashboard', [
            'title' => 'Book Management',
            'books'         => $this->bookModel->paginate(15),
            'pager'         => $this->bookModel->pager,
            'keyword'       => $keyword,
            'navCategories' => $this->navCategories,
        ]);
    }

    public function store(): mixed
    {
        $session = session();

        $rules = array_merge($this->bookModel->getValidationRules(), [
            'image' => 'if_exist|uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $admin_id = $session->get('admin_id');
        $admin_name = $session->get('admin_name');
        $admin_email = $session->get('admin_email');

        $this->db->query("SET @admin_id = ?", $admin_id);
        $this->db->query("SET @admin_username = ?", $admin_name);
        $this->db->query("SET @admin_email = ?", $admin_email);


        $this->bookModel->insert([
            'category_id'  => $this->request->getPost('category_id') ?: null,
            'title'        => $this->request->getPost('title'),
            'author'       => $this->request->getPost('author'),
            'publisher'    => $this->request->getPost('publisher'),
            'release_date' => $this->request->getPost('release_date'),
            'sipnosis'     => $this->request->getPost('sipnosis'),
            'price'        => (int) $this->request->getPost('price'),
            'img_url'      => $this->handleImageUpload(),
        ]);

        return redirect()->to('admin')->with('success', 'Book added successfully!');
    }

    public function update(int $id): mixed
    {
        $session = session();

        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Book with ID {$id} not found."
            );
        }

        $rules = array_merge($this->bookModel->getValidationRules(), [
            'image' => 'if_exist|is_image[image]|max_size[image,2048]',
        ]);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $admin_id = $session->get('admin_id');
        $admin_name = $session->get('admin_name');
        $admin_email = $session->get('admin_email');

        $this->db->query("SET @admin_id = ?", $admin_id);
        $this->db->query("SET @admin_username = ?", $admin_name);
        $this->db->query("SET @admin_email = ?", $admin_email);

        $data = [
            'category_id'  => $this->request->getPost('category_id') ?: null,
            'title'        => $this->request->getPost('title'),
            'author'       => $this->request->getPost('author'),
            'publisher'    => $this->request->getPost('publisher'),
            'release_date' => $this->request->getPost('release_date'),
            'sipnosis'     => $this->request->getPost('sipnosis'),
            'price'        => (int) $this->request->getPost('price'),
        ];

        $newImage = $this->handleImageUpload();
        if ($newImage !== null) {
            $data['img_url'] = $newImage;
        }

        $this->bookModel->update($id, $data);

        return redirect()->to('admin')->with('success', 'Book updated successfully!');
    }

    public function delete(int $id): mixed
    {
        $session = session();

        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Book with ID {$id} not found."
            );
        }

        $admin_id = $session->get('admin_id');
        $admin_name = $session->get('admin_name');
        $admin_email = $session->get('admin_email');

        $this->db->query("SET @admin_id = ?", $admin_id);
        $this->db->query("SET @admin_username = ?", $admin_name);
        $this->db->query("SET @admin_email = ?", $admin_email);

        $this->bookModel->delete($id);

        return redirect()->to('admin')->with('warning', 'Book has been deleted.');
    }

    // -----------------------------------------------------------------------
    // PRIVATE HELPERS
    // -----------------------------------------------------------------------

    private function handleImageUpload(): ?string
    {
        $file = $this->request->getFile('image');

        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $newName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads/books', $newName);

        return $newName;
    }
}
