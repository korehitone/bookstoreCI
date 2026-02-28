<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Book;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;

class CategoryController extends BaseController
{
    protected Category $categoryModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
        $this->categoryModel = new Category();
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
    // PUBLIC — User Facing
    // -----------------------------------------------------------------------

    public function index(): string
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->categoryModel->like('name', $keyword);
        }

        return view('bookstore/categories', [
            'title'         => 'Book Categories',
            'categories'    => $this->categoryModel->paginate(12),
            'pager'         => $this->categoryModel->pager,
            'keyword'       => $keyword,
            'navCategories' => $this->navCategories,
        ]);
    }

    public function show(int $id): mixed
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        $bookModel = new Book();
        $bookModel->where('category_id', $id);

        return view('bookstore/categoryBooks', [
            'title'         => esc($category['name']),
            'category'      => $category,
            'books'         => $bookModel->paginate(12),
            'pager'         => $bookModel->pager,
            'navCategories' => $this->navCategories,
        ]);
    }

    // -----------------------------------------------------------------------
    // ADMIN — Protected CRUD
    // -----------------------------------------------------------------------

    public function admin_index(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->categoryModel->like('name', $keyword);
        }

        return view('bookstore/adminCategory', [
            'categories' => $this->categoryModel->paginate(15),
            'pager'      => $this->categoryModel->pager,
            'keyword'    => $keyword,
        ]);
    }

    public function store(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        if (!$this->validate($this->categoryModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->insert([
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Category created successfully!');
    }

    public function update(int $id): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        $rules = [
            'name' => "required|min_length[2]|max_length[50]|is_unique[category.name,id,{$id}]",
        ];

        $messages = [
            'name' => ['is_unique' => 'Another category with that name already exists.'],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Category updated successfully!');
    }

    public function delete(int $id): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        $this->categoryModel->delete($id);

        return redirect()->to('/admin/categories')->with('warning', 'Category has been deleted.');
    }
}