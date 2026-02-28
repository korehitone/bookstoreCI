<?= $this->extend('layout/authLayout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
                <!-- Password Reset Card -->
                <div class="card border shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center fw-bold mb-2">Reset Password</h3>
                        <p class="text-muted text-center mb-4 small">
                            Enter your email address and a new password to reset your account
                        </p>

                        <form action="<?= base_url('/forgot-password') ?>" method="post" novalidate>
                            <?= csrf_field() ?>

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

                            <!-- New Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">New Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['password'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Enter new password (min 6 characters)"
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
                                    placeholder="Confirm password"
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
                                Reset Password
                            </button>

                            <!-- Back to Login Link -->
                            <div class="text-center">
                                <a href="<?= base_url('/login') ?>" class="text-decoration-none small fw-semibold">
                                    Back to Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?= $this->endSection() ?>