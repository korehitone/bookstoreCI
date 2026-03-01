<?= $this->extend('admin/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
                <!-- Login Card -->
                <div class="card border shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center fw-bold mb-4">Admin Login</h3>

                        <form action="<?= base_url('admin/login') ?>" method="post" novalidate>
                            <?= csrf_field() ?>

                            <!-- Username Field -->
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="form-control rounded-2 <?= (session()->getFlashdata('errors')['username'] ?? false) ? 'is-invalid' : '' ?>"
                                    placeholder="Enter your username"
                                    value="<?= esc(old('username')) ?>"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['username'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['username']) ?>
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
                                    placeholder="Enter your password"
                                    required
                                >
                                <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
                                    <div class="invalid-feedback d-block">
                                        <?= esc(session()->getFlashdata('errors')['password']) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Forgot Password Link -->
                                <!-- <div class="text-end mt-2">
                                    <a href="<>?= base_url('/forgot-password') ?>" class="text-decoration-none small fw-semibold">
                                        Forgot Password?
                                    </a>
                                </div> -->
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 fw-semibold rounded-2 mb-3">
                                Login
                            </button>

                            <!-- Sign Up Link -->
                            <div class="text-center">
                                <span class="text-muted">Don't have an account?</span>
                                <a href="<?= base_url('admin/register') ?>" class="text-decoration-none fw-semibold">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?= $this->endSection() ?>