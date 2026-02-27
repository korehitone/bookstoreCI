<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{
    protected Category $categoryModel;

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
    // PUBLIC — user-facing category listing
    // -----------------------------------------------------------------------

    // Show all categories with their book counts (public page)
    public function index(): string
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->categoryModel->like('name', $keyword);
        }

        $data = [
            'title'          => 'Book Categories',
            'categories'     => $this->categoryModel->paginate(12),
            'pager'          => $this->categoryModel->pager,
            'keyword'        => $keyword,
            'navCategories'  => $this->categoryModel->findAll(),
        ];

        return view('bookstore/categories', $data);
    }

    // Show all books under a specific category
    public function show(int $id): mixed
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        // Get all books under this category via the pivot table
        $db = \Config\Database::connect();

        $books = $db->table('book')
            ->select('book.*')
            ->join('category_book', 'category_book.book_id = book.id')
            ->where('category_book.category_id', $id)
            ->get()
            ->getResultArray();

        return view('bookstore/categoryBooks', [
            'title'          => "Books in: {$category['name']}",
            'category'       => $category,
            'books'          => $books,
            'navCategories'  => $this->categoryModel->findAll(),
        ]);
    }

    // -----------------------------------------------------------------------
    // ADMIN — protected CRUD
    // -----------------------------------------------------------------------

    // Admin: list all categories with search + pagination
    public function admin_index(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $this->categoryModel->like('name', $keyword);
        }

        $data = [
            'categories' => $this->categoryModel->paginate(15),
            'pager'      => $this->categoryModel->pager,
            'keyword'    => $keyword,
        ];

        return view('bookstore/adminCategory', $data); // fixed path
    }

    // Admin: show create form
    public function create(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        return view('admin/categories/form', ['category' => null]);
    }

    // Admin: handle create POST
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

    // Admin: show edit form
    public function edit(int $id): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        return view('admin/categories/form', ['category' => $category]);
    }

    // Admin: handle update POST
    public function update(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->back()->with('error', 'Invalid category ID.');
        }

        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Category with ID {$id} not found."
            );
        }

        // is_unique must ignore the category's own current row
        $rules = [
            'name' => "required|min_length[2]|max_length[255]|is_unique[category.name,id,{$id}]",
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

    // Admin: handle delete
    public function delete(): mixed
    {
        if ($redirect = $this->requireLogin()) return $redirect;

        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->back()->with('error', 'Invalid category ID.');
        }

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