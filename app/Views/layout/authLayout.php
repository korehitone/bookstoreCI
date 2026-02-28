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

    <!-- ===================================================================
         MINIMAL HEADER - Auth Pages Only
    =================================================================== -->
    <header class="bg-white border-bottom py-3 shadow-sm">
        <div class="container-fluid">
            <h4 class="mb-0">
                <a href="<?= base_url('/') ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
            </h4>
        </div>
    </header>

    <!-- ===================================================================
         MAIN CONTENT
    =================================================================== -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ===================================================================
         FOOTER
    =================================================================== -->
    <footer class="bg-white border-top py-3 text-center text-muted small">
        <div class="container-fluid">
            <p class="mb-0">&copy; 2026 Online Bookstore. All rights reserved.</p>
        </div>
    </footer>

    <!-- ===================================================================
         SCRIPTS
    =================================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('extra-js') ?>

</body>
</html>
