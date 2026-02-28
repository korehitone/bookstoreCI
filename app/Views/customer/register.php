<?= $this->extend('base') ?>
<?= $this->section('content') ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card border shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Register</h3>

                    <?php
                    $validation = \Config\Services::validation();
                    $errors = session()->getFlashdata('errors');
                  
                    if ($errors) {
                        foreach ($errors as $field => $message) {
                            $validation->setError($field, $message);
                        }
                    }
                    ?>

                    <!-- <form> -->
                    <?= form_open('register/save'); ?>
                    <?= csrf_field(); ?>

                    <div class="form-group mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                            name="username" id="username" placeholder="Enter username" value="<?= old('username'); ?>">
                        
                        <?php if ($validation->getError('username')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->showError('username'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                            name="email" id="email" placeholder="Enter email" value="<?= old('email'); ?>">
                      
                        <?php if ($validation->getError('email')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->showError('email'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>"
                            name="password" id="password" placeholder="Enter password">
                        
                        <?php if ($validation->getError('password')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="confpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('confpassword')) ? 'is-invalid' : '' ?>"
                            name="confpassword" id="confpassword" placeholder="Confirm password">
                
                        <?php if ($validation->getError('confpassword')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('confpassword'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3" placeholder="Enter address"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-dark w-100 mb-3">Register</button>
                    </div>
                    <div class="text-center">
                        <span class="text-muted">Already have an account?</span>
                        <a href="<?= base_url('login') ?>" class="text-decoration-none">Login</a>
                    </div>

                    <?= form_close(); ?>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>