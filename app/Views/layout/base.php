<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= esc($title ?? 'Online Bookstore') ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <?php if (session()->get('isAdmin')): ?>
    <!-- ================================================================
         ADMIN HEADER
    ================================================================ -->
    <header class="bg-white border-bottom py-3 shadow-sm">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <h4 class="mb-0">
                        <a href="<?= base_url('admin/books') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                    </h4>
                    <div class="d-flex gap-3">
                        <a href="<?= base_url('admin/books') ?>" class="text-decoration-none text-dark">Books</a>
                        <a href="<?= base_url('admin/categories') ?>" class="text-decoration-none text-dark">Categories</a>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted small">Hello, <?= esc(session()->get('username')) ?></span>
                    <a href="<?= base_url('admin/profile') ?>" class="text-decoration-none text-dark">Profile</a>
                </div>
            </div>
        </div>
    </header>

    <?php elseif (session()->get('isLoggedIn')): ?>
    <!-- ================================================================
         LOGGED-IN CUSTOMER HEADER
    ================================================================ -->
    <header class="bg-light border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <h4 class="mb-0">
                    <a href="<?= base_url('books') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                </h4>
                <div class="d-flex gap-3 align-items-center">
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark dropdown-toggle"
                        href="#" role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (!empty($navCategories)): ?>
                                <?php foreach ($navCategories as $cat): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('/categories/' . $cat['id']) ?>">
                                            <?= esc($cat['name']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span class="dropdown-item text-muted">No categories yet</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <a href="<?= base_url('/cart') ?>" class="text-decoration-none text-dark">Cart</a>
                    <a href="<?= base_url('/profile') ?>" class="text-decoration-none text-dark">
                        <?= esc(session()->get('username')) ?>
                    </a>
                    <a href="<?= base_url('/logout') ?>" class="text-decoration-none text-danger">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <?php else: ?>
    <!-- ================================================================
         GUEST HEADER (not logged in)
    ================================================================ -->
    <header class="bg-light border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <h4 class="mb-0">
                    <a href="<?= base_url('books') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                </h4>
                <div class="d-flex gap-3 align-items-center">
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark dropdown-toggle"
                        href="#" role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (!empty($navCategories)): ?>
                                <?php foreach ($navCategories as $cat): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('/categories/' . $cat['id']) ?>">
                                            <?= esc($cat['name']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span class="dropdown-item text-muted">No categories yet</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <a href="<?= base_url('/login') ?>" class="text-decoration-none text-dark">Login</a>
                    <a href="<?= base_url('/register') ?>" class="btn btn-dark btn-sm">Register</a>
                </div>
            </div>
        </div>
    </header>
    <?php endif; ?>

    <!-- ================================================================
         FLASH MESSAGES — shown on all pages
    ================================================================ -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
            <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert">
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-0 rounded-0" role="alert">
            <?= esc(session()->getFlashdata('warning')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ================================================================
         MAIN CONTENT
    ================================================================ -->
    <main class="flex-grow-1 py-5">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container-fluid text-center text-muted">
            <p class="mb-0">MyApp © 2026</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('extra-js') ?>
</body>
</html>