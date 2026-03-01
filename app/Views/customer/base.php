<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= $title; ?></title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="bg-light border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-dark">MyApp</a>
                </h4>

                <?php
                $dflex = match (strtolower($title)) {
                    'login', 'register' => 'd-none',
                    default => 'd-flex'
                }
                ?>
                <div class="<?= $dflex ?> gap-3">
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">Light Novel</a></li>
                            <li><a class="dropdown-item" href="#">Children Book</a></li>
                            <li><a class="dropdown-item" href="#">Comics</a></li>
                            <li><a class="dropdown-item" href="#">Non-Fiction</a></li>
                            <li><a class="dropdown-item" href="#">Fiction</a></li> -->

                            <?php if (!empty($navCategories)): ?>
                                <?php foreach ($navCategories as $cat): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('categories/' . $cat['id']) ?>">
                                            <?= esc($cat['name']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span class="dropdown-item text-muted disabled">No categories</span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if (session()->get("logged_in") && session()->get('role') == 'customer'): ?>
                        <a href="<?= base_url('cart') ?>" class="text-decoration-none text-dark">Cart</a>
                        <a href="<?= base_url('profile') ?>" class="text-decoration-none text-dark"><?= esc(session()->get('user_name')) ?></a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="text-decoration-none text-dark">Login</a>
                        <a href="<?= base_url('register') ?>" class="btn btn-dark btn-sm">Register</a>
                    <?php endif ?>
                </div>

            </div>
        </div>
    </header>

    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success">
            <?php echo session()->getFlashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger">
            <?php echo session()->getFlashdata('error'); ?>
        </div>
    <?php } ?>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-light border-top py-3 mt-auto">
        <div class="container-fluid">
            <p class="text-center mb-0 text-muted">MyApp © 2024</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>