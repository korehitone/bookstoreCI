<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">

    <!-- ===================================================================
         PAGE HEADER
    =================================================================== -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-2"><?= esc($category['name']) ?></h2>
            <p class="text-muted">
                <?= count($books) ?> book<?= count($books) !== 1 ? 's' : '' ?> in this category
            </p>
            <a href="<?= base_url('books') ?>" class="text-decoration-none text-muted small">← Back to all books</a>
        </div>
    </div>

    <!-- ===================================================================
         BOOKS GRID
    =================================================================== -->
    <div class="row g-4">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <!-- Book Cover -->
                                <div class="col-4">
                                    <div class="bg-gradient bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center p-2" style="height: 160px;">
                                        <?php if (!empty($book['img_url'])): ?>
                                            <img 
                                                src="<?= base_url('uploads/books/' . esc($book['img_url'])) ?>" 
                                                alt="<?= esc($book['title']) ?>"
                                                class="img-fluid rounded shadow-sm" 
                                                style="max-height: 100%; object-fit: cover;"
                                            >
                                        <?php else: ?>
                                            <span class="text-primary fw-semibold small">No Cover</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="col-8 d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2"><?= esc($book['title']) ?></h5>
                                    <p class="text-muted small mb-2"><?= esc($book['author']) ?></p>
                                    <div class="mt-auto">
                                        <p class="h5 text-primary fw-bold mb-3">IDR <?= number_format($book['price'], 0, ',', '.') ?></p>
                                        <a href="<?= base_url('books/' . $book['id']) ?>" class="btn btn-dark w-100 rounded-pill btn-sm">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">No books in this category yet.</h4>
                <a href="<?= base_url('books') ?>" class="btn btn-link">Show all books</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- ===================================================================
         PAGINATION
    =================================================================== -->
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            <?php if (isset($pager)): ?>
                <?= $pager->links() ?>
            <?php endif; ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>