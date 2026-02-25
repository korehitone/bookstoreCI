<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    
    <title><?= $title ?? 'MyApp'; ?></title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <header class="bg-white border-bottom py-3">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <a href="<?= base_url() ?>" class="text-decoration-none text-dark fw-bold">MyApp</a>
                </h4>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <div class="container py-4">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container-fluid text-center">
            <p class="mb-1 text-muted">MyApp © 2025</p>
            <div class="text-secondary small">
                Page rendered in <strong>{elapsed_time}</strong> seconds | 
                CodeIgniter v<?= CodeIgniter\CodeIgniter::CI_VERSION ?>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('extra-js') ?>
</body>
</html>