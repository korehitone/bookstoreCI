<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card border shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Login</h3>

                    <?php
                    $validation = \Config\Services::validation();
                    $errors = session()->getFlashdata('errors');

                    if ($errors) {
                        foreach ($errors as $field => $message) {
                            $validation->setError($field, $message);
                        }
                    }
                    ?>

                    <!-- <>?php // if (session()->getFlashdata('msg')): ?>
                            <div class="alert alert-danger"><>?= //session()->getFlashdata('msg') ?></div>
                        <>?php // endif; ?> -->

                    <?= form_open('login/auth'); ?>
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="Enter email" value="<?= set_value('email') ?>">
                        <?php if ($validation->getError('email')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->showError('email'); ?>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Enter password">
                        <!-- <div class="text-end mt-2">
                                    <a href="forgotPass.html" class="text-decoration-none small">Forgot Password?</a>
                                </div> -->
                        <?php if ($validation->getError('password')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->showError('password'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 mb-3">Login</button>

                    <div class="text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="<?= base_url('register') ?>" class="text-decoration-none">Sign Up</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>