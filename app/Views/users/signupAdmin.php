<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title>Sign Up Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="bg-light border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                </h4>
            </div>
        </div>
    </header>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="card border shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">Admin Sign Up</h3>

                            <form action="<?= base_url('/register/admin') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input
                                        type="text"
                                        name="username"
                                        id="username"
                                        class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username']) ? 'is-invalid' : '' ?>"
                                        placeholder="Enter username"
                                        value="<?= esc(old('username')) ?>"
                                    >
                                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username'])): ?>
                                        <div class="invalid-feedback">
                                            <?= esc(session()->getFlashdata('errors')['username']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email']) ? 'is-invalid' : '' ?>"
                                        placeholder="Enter email"
                                        value="<?= esc(old('email')) ?>"
                                    >
                                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                                        <div class="invalid-feedback">
                                            <?= esc(session()->getFlashdata('errors')['email']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password']) ? 'is-invalid' : '' ?>"
                                        placeholder="Enter password"
                                    >
                                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password'])): ?>
                                        <div class="invalid-feedback">
                                            <?= esc(session()->getFlashdata('errors')['password']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input
                                        type="password"
                                        name="confirm_password"
                                        id="confirm_password"
                                        class="form-control <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['confirm_password']) ? 'is-invalid' : '' ?>"
                                        placeholder="Confirm password"
                                    >
                                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['confirm_password'])): ?>
                                        <div class="invalid-feedback">
                                            <?= esc(session()->getFlashdata('errors')['confirm_password']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <button type="submit" class="btn btn-dark w-100 mb-3">Sign Up</button>

                                <div class="text-center">
                                    <span class="text-muted">Already have an account?</span>
                                    <a href="<?= base_url('/login') ?>" class="text-decoration-none">Login</a>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-light border-top py-3 mt-auto">
        <div class="container-fluid">
            <p class="text-center mb-0 text-muted">MyApp © 2026</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>