<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use CodeIgniter\HTTP\ResponseInterface;

class BookController extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    // 1. Show all books (Index for users)
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            // Search in title, author, or synopsis
            $books = $this->bookModel->like('title', $keyword)
                                    ->orLike('author', $keyword)
                                    ->orLike('sipnosis', $keyword)
                                    ->findAll();
        } else {
            $books = $this->bookModel->findAll();
        }

        $data = [
            'title'   => 'Our Book Collection',
            'books'   => $books,
            'keyword' => $keyword // Pass it back to keep the text in the input
        ];

        return view('bookstore/index', $data);
    }

    // 2. Show book details
    public function details($id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Book with ID $id not found.");
        }

        return view('bookstore/bookPage', ['book' => $book]);
    }

    // --- ADMIN CRUD SECTION ---

    // List all for Admin (usually a table)
    public function admin_index()
    {
        $data = [
            'isAdmin' => true, // This hides the customer header
            'books'   => $this->bookModel->findAll()
        ];
        return view('admin/dashboard', $data);
    }

    // Show create form
    public function create()
    {
        return view('users/indexAdmin');
    }

    // Handle create POST
    public function store()
    {
        $data = $this->request->getPost();
        
        if ($this->bookModel->save($data)) {
            return redirect()->to('users/indexAdmin')->with('success', 'Book added successfully!');
        }
        
        return redirect()->back()->withInput()->with('errors', $this->bookModel->errors());
    }

    // Show edit form
    public function edit($id)
    {
        $data['book'] = $this->bookModel->find($id);
        return view('users/indexAdmin', $data);
    }

    // Handle update POST
    public function update($id)
    {
        $data = $this->request->getPost();
        
        if ($this->bookModel->update($id, $data)) {
            return redirect()->to('users/indexAdmin')->with('success', 'Book updated!');
        }

        return redirect()->back()->withInput();
    }

    // Handle delete
    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('users/indexAdmin')->with('danger', 'Book deleted.');
    }
}
