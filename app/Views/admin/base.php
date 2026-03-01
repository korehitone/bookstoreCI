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

    <header class="bg-white border-bottom py-3 shadow-sm">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <h4 class="mb-0">
                        <a href="<?= base_url('admin') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                    </h4>

                    <?php
                    $dflex = match (strtolower($title)) {
                        'login', 'register' => 'd-none',
                        default => 'd-flex'
                    }

                    // $dflex = 'd-flex';
                    ?>

                    <nav class="<?= $dflex ?> gap-3">
                        <a href="<?= base_url('admin') ?>" class="text-decoration-none text-dark">Books</a>
                        <a href="<?= base_url('admin/categories') ?>" class="text-decoration-none text-dark">Categories</a>
                        <a href="<?= base_url('admin/logs') ?>" class="text-decoration-none text-dark">Logs</a>
                    </nav>
                </div>
                <div class="<?= $dflex ?> align-items-center gap-3">
                    <span class="text-muted small">Hello, <?= esc(session()->get('admin_name') ?? 'Admin') ?></span>
                    <a href="<?= base_url('admin/profile') ?>" class="text-decoration-none text-dark">Profile</a>
                </div>
            </div>
        </div>
    </header>



    <!-- ===================================================================
         FLASH MESSAGES - Global notifications
    =================================================================== -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
            <strong>Success:</strong> <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert">
            <strong>Error:</strong> <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-0 rounded-0" role="alert">
            <strong>Warning:</strong> <?= esc(session()->getFlashdata('warning')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- ===================================================================
         MAIN CONTENT
    =================================================================== -->
    <main class="flex-grow-1 py-5">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ===================================================================
         FOOTER
    =================================================================== -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container-fluid text-center text-muted">
            <p class="mb-0">MyApp © 2026</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('extra-js') ?>
</body>

</html>