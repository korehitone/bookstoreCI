<?= $this->extend('admin/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
                <!-- Registration Card -->
                <div class="card border shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center fw-bold mb-4">Admin Sign Up</h3>

                        <form action="<?= base_url('admin/register') ?>" method="post" novalidate>
                            <?= csrf_field() ?>

                            <!-- Username Field -->
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['username'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Enter username"
                                    value="<?= esc(old('username')) ?>"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['username'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['username']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['email'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Enter your email"
                                    value="<?= esc(old('email')) ?>"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['email']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['password'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Enter password (min 6 characters)"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['password']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
                                <input
                                    type="password"
                                    name="confirm_password"
                                    id="confirm_password"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['confirm_password'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Confirm your password"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['confirm_password'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['confirm_password']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 fw-semibold rounded-2 mb-3">
                                Create Account
                            </button>

                            <!-- Login Link -->
                            <div class="text-center">
                                <span class="text-muted">Already have an account?</span>
                                <a href="<?= base_url('/login') ?>" class="text-decoration-none fw-semibold">Login</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?= $this->endSection() ?>