<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Book;
use CodeIgniter\HTTP\ResponseInterface;

class BookController extends BaseController
{
    protected Book $bookModel;

    // -----------------------------------------------------------------------
    // PUBLIC - USER FACING
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

        $data = [
            'title'          => 'Our Book Collection',
            'books'          => $this->bookModel->paginate(12),
            'pager'          => $this->bookModel->pager,
            'keyword'        => $keyword,
            'navCategories'  => $this->categoryModel->findAll(),
        ];

        return view('bookstore/index', $data);
    }

    public function details(int $id): string
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Book with ID {$id} not found."
            );
        }

        return view('bookstore/bookPage', [
            'book'           => $book,
            'navCategories'  => $this->categoryModel->findAll(),
        ]);
    }

    // -----------------------------------------------------------------------
    // ADMIN - PROTECTED
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

        $data = [
            'books'          => $this->bookModel->paginate(15),
            'pager'          => $this->bookModel->pager,
            'keyword'        => $keyword,
            'navCategories'  => $this->categoryModel->findAll(),
        ];

        return view('bookstore/indexAdmin', $data);
    }

    public function store()
    {
        $rules = array_merge($this->bookModel->getValidationRules(), [
            'image' => 'if_exist|uploaded[image]|is_image[image]|max_size[image,2048]',
        ]);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'category_id'  => $this->request->getPost('category_id') ?: null,
            'title'        => $this->request->getPost('title'),
            'author'       => $this->request->getPost('author'),
            'publisher'    => $this->request->getPost('publisher'),
            'release_date' => $this->request->getPost('release_date'),
            'sipnosis'     => $this->request->getPost('sipnosis'),
            'price'        => (int) $this->request->getPost('price'),
            'img_url'      => $this->handleImageUpload(),
        ];

        $this->bookModel->insert($data);

        return redirect()->to('/admin/books')->with('success', 'Book added successfully!');
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        if (!$id) {
            return redirect()->back()->with('error', 'Invalid book ID.');
        }

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

        return redirect()->to('/admin/books')->with('success', 'Book updated successfully!');
    }

    public function delete(int $id)
    {
        $book = $this->bookModel->find($id);

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                "Book with ID {$id} not found."
            );
        }

        $this->bookModel->delete($id);

        return redirect()->to('/admin/books')->with('warning', 'Book has been deleted.');
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
