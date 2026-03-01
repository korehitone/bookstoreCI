<?= $this->extend('admin/base') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4 p-md-5">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-1">Categories Management</h2>
                    <p class="text-muted mb-0">Manage your category list</p>
                </div>
                <button class="btn btn-primary px-4 shadow-sm rounded-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-lg me-1"></i> Add Category
                </button>
            </div>

            <!-- SEARCH BAR -->
            <form method="get" action="<?= base_url('admin/categories') ?>" class="mb-4">
                <div class="input-group w-100">
                    <input
                        type="search"
                        name="keyword"
                        class="form-control"
                        placeholder="Search categories..."
                        value="<?= esc($keyword ?? '') ?>"
                    >
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Name</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories) && is_array($categories)): ?>
                            <?php $counter = 1; ?>
                            <?php foreach ($categories as $category): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= $counter++ ?></td>
                                <td class="fw-semibold"><?= esc($category['name']) ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Edit Button -->
                                        <button
                                            class="btn btn-sm btn-warning rounded-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal"
                                            onclick='fillEditModal(<?= json_encode($category) ?>)'
                                            title="Edit this category"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill me-1" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg>
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <button
                                            class="btn btn-sm btn-danger rounded-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmModal"
                                            onclick="setDeleteId(<?= $category['id'] ?>, '<?= esc($category['name']) ?>')"
                                            title="Delete this category"
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
                                <td colspan="3" class="text-center py-5 text-muted">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if (isset($pager)): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- ===================================================================
     MODALS
=================================================================== -->

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="<?= base_url('admin/categories/store') ?>" method="post" novalidate>
                <?= csrf_field() ?>
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control rounded-2"
                            placeholder="Enter category name"
                            maxlength="50"
                            required
                        >
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-2 px-4">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="" method="post" id="editCategoryForm" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input
                            type="text"
                            name="name"
                            id="edit_name"
                            class="form-control rounded-2"
                            maxlength="50"
                            required
                        >
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-2 px-4">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <p class="mb-0">Are you sure you want to delete <strong id="deleteCategoryName"></strong>? This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-2" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger rounded-2 px-4" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<!-- ===================================================================
     JAVASCRIPT
=================================================================== -->
<?= $this->section('extra-js') ?>
<script>
    // Store the ID to delete
    let deleteCategoryId = null;

    /**
     * Set category ID and name for delete confirmation modal
     */
    function setDeleteId(id, name) {
        deleteCategoryId = id;
        document.getElementById('deleteCategoryName').textContent = name;
    }

    /**
     * Confirm and execute delete (GET redirect)
     */
    function confirmDelete() {
        if (deleteCategoryId) {
            window.location.href = '<?= base_url('admin/categories/delete/') ?>' + deleteCategoryId;
        }
    }

    /**
     * Populate edit modal with category data and set form action
     */
    function fillEditModal(category) {
        document.getElementById('edit_id').value = category.id;
        document.getElementById('edit_name').value = category.name;
        // Set the form action to include the category ID
        document.getElementById('editCategoryForm').action = '<?= base_url('admin/categories/update/') ?>' + category.id;
    }
</script>
<?= $this->endSection() ?>