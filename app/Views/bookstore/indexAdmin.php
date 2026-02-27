<?= $this->extend('layout/base') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4 p-md-5">

            <!-- Title and Actions -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Books Management</h2>
                    <p class="text-muted mb-0">Manage your book inventory</p>
                </div>
                <button class="btn btn-primary px-4 shadow-sm rounded-3" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Book
                </button>
            </div>

            <!-- Search Bar — full width, input left, button right -->
            <form method="get" action="<?= base_url('/admin/books') ?>" class="mb-4">
                <div class="input-group w-100">
                    <input
                        type="search"
                        name="keyword"
                        class="form-control"
                        placeholder="Search by title, author, or synopsis..."
                        value="<?= esc($keyword ?? '') ?>"
                    >
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 100px;">Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($books) && is_array($books)): ?>
                            <?php foreach ($books as $book): ?>
                            <tr>
                                <td>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 60px; height: 80px; overflow: hidden;">
                                        <?php if (!empty($book['img_url'])): ?>
                                            <img src="<?= base_url('uploads/books/' . esc($book['img_url'])) ?>" class="img-fluid" style="object-fit: cover; width: 60px; height: 80px;" alt="cover">
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size: 10px;">No Image</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="fw-semibold"><?= esc($book['title']) ?></td>
                                <td class="text-muted"><?= esc($book['author']) ?></td>
                                <td class="text-muted">
                                    <span class="badge bg-secondary-subtle text-dark border">
                                        <?= esc($book['category_name'] ?? '—') ?>
                                    </span>
                                </td>
                                <td class="fw-bold text-primary">IDR <?= number_format($book['price'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button
                                            class="btn btn-sm btn-warning rounded-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBookModal"
                                            onclick="fillEditModal(<?= htmlspecialchars(json_encode($book)) ?>)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill me-1" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg>
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger rounded-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            onclick="setDeleteBookId(<?= $book['id'] ?>, '<?= esc($book['title']) ?>')"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill me-1" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No books found in inventory.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (isset($pager)): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- ================================================================
     ADD BOOK MODAL
================================================================ -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="<?= base_url('admin/books/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Author</label>
                            <input type="text" name="author" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select rounded-3">
                                <option value="">— Select Category —</option>
                                <?php foreach ($navCategories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Publisher</label>
                            <input type="text" name="publisher" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Release Date</label>
                            <input type="date" name="release_date" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Price (IDR)</label>
                            <input type="number" name="price" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Synopsis</label>
                        <textarea name="sipnosis" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cover Image</label>
                        <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">Save Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================================================================
     EDIT BOOK MODAL
================================================================ -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="" method="post" enctype="multipart/form-data" id="editBookForm">
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" id="edit_title" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Author</label>
                            <input type="text" name="author" id="edit_author" class="form-control rounded-3" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" id="edit_category_id" class="form-select rounded-3">
                                <option value="">— Select Category —</option>
                                <?php foreach ($navCategories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Publisher</label>
                            <input type="text" name="publisher" id="edit_publisher" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Release Date</label>
                            <input type="date" name="release_date" id="edit_release_date" class="form-control rounded-3">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Price (IDR)</label>
                            <input type="number" name="price" id="edit_price" class="form-control rounded-3" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Synopsis</label>
                        <textarea name="sipnosis" id="edit_sipnosis" class="form-control rounded-3" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cover Image</label>
                        <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                        <small class="text-muted d-block mt-2">Leave blank to keep existing image</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================================================================
     DELETE CONFIRM MODAL
================================================================ -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <p class="mb-0">Are you sure you want to delete <strong id="deleteBookTitle"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger rounded-3 px-4" onclick="confirmDeleteBook()">Delete</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    let deleteBookId = null;

    function setDeleteBookId(id, title) {
        deleteBookId = id;
        document.getElementById('deleteBookTitle').textContent = title;
    }

    function confirmDeleteBook() {
        if (deleteBookId) {
            window.location.href = "<?= base_url('admin/books/delete/') ?>" + deleteBookId;
        }
    }

    function fillEditModal(book) {
        // Set form action to include the book ID in the URL
        document.getElementById('editBookForm').action = "<?= base_url('admin/books/update/') ?>" + book.id;

        document.getElementById('edit_title').value        = book.title;
        document.getElementById('edit_author').value       = book.author;
        document.getElementById('edit_publisher').value    = book.publisher    || '';
        document.getElementById('edit_release_date').value = book.release_date || '';
        document.getElementById('edit_price').value        = book.price;
        document.getElementById('edit_sipnosis').value     = book.sipnosis     || '';

        // Set the correct category in the dropdown
        document.getElementById('edit_category_id').value = book.category_id || '';
    }
</script>
<?= $this->endSection() ?>