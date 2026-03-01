<?= $this->extend('admin/base') ?>

<?= $this->section('content') ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                <!-- Profile Card -->
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-4 p-md-5">

                        <!-- Profile Header with Actions -->
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                            <h4 class="fw-bold mb-0">Admin Profile</h4>
                            <div class="d-flex gap-2 flex-wrap">
                                <!-- Edit Button -->
                                <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill me-1" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill me-1" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>

                        <!-- Profile Information Grid -->
                        <div class="row g-4">

                            <!-- Username Display -->
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge text-primary" viewBox="0 0 16 16">
                                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted small mb-1">Username</p>
                                        <p class="fw-semibold mb-0"><?= esc($admin['username'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Display -->
                            <div class="col-12">
                                <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope-fill text-success" viewBox="0 0 16 16">
                                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted small mb-1">Email Address</p>
                                        <p class="fw-semibold mb-0"><?= esc($admin['email'] ?? 'N/A') ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- Logout Button -->
                        <div class="text-center">
                            <a href="<?= base_url('admin/logout') ?>" class="btn btn-outline-secondary rounded-3 px-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                Logout
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<!-- ===================================================================
     MODALS
=================================================================== -->

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="<?= base_url('/admin/profile/update') ?>" method="post" novalidate>
                <?= csrf_field() ?>

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 pb-4">
                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="editUsername" class="form-label fw-semibold">Username</label>
                        <input 
                            type="text" 
                            class="form-control rounded-2" 
                            id="editUsername" 
                            name="username" 
                            value="<?= esc($admin['username'] ?? '') ?>" 
                            required
                        >
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="editEmail" class="form-label fw-semibold">Email Address</label>
                        <input 
                            type="email" 
                            class="form-control rounded-2" 
                            id="editEmail" 
                            name="email" 
                            value="<?= esc($admin['email'] ?? '') ?>" 
                            required
                            readonly
                        >
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-2 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-2 px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger" id="deleteConfirmModalLabel">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4">
                <div class="text-center my-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-triangle text-danger mb-3" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg>
                    <p class="mb-0 fw-semibold">Are you sure you want to delete this account?</p>
                    <p class="text-muted small mb-0 mt-2">This action cannot be undone. All your data will be permanently removed.</p>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-2 px-4" data-bs-dismiss="modal">Cancel</button>
                <form action="<?= base_url('/admin/profile/delete') ?>" method="post" class="d-inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger rounded-2 px-4">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>   <!-- This line was missing -->