<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= $title ?? 'Online Bookstore'; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php if (!isset($isAdmin) || !$isAdmin): ?>
    <header class="bg-light border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <h4 class="mb-0">
                    <a href="<?= base_url() ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                </h4>
                <div class="d-flex gap-3">
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Light Novel</a></li>
                            <li><a class="dropdown-item" href="#">Fiction</a></li>
                        </ul>
                    </div>
                    <a href="#" class="text-decoration-none text-dark">Cart</a>
                    <a href="#" class="text-decoration-none text-dark">User</a>
                </div>
            </div>
        </div>
    </header>
    <?php endif; ?>

    <main class="flex-grow-1 bg-light py-5">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-light border-top py-3 mt-auto">
        <div class="container-fluid text-center text-muted">
            <p class="mb-0">MyApp © 2026</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('extra-js') ?>
</body>
</html>