<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-2">Featured Books</h2>
            <p class="text-muted">Discover our curated collection of timeless classics</p>

            <div class="mt-4">
                <form action="<?= base_url('books') ?>" method="get" class="w-100">
                    <div class="input-group shadow-sm">
                        <input type="search" name="keyword" class="form-control border-0 py-3" placeholder="Search by title or author..." value="<?= esc($keyword ?? '') ?>">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="bg-gradient bg-primary bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center p-2" style="height: 160px;">
                                        <?php if ($book['img_url']): ?>
                                            <img src="<?= base_url('uploads/' . $book['img_url']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 100%;">
                                        <?php else: ?>
                                            <span class="text-primary fw-semibold small">No Cover</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-8 d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-2"><?= esc($book['title']) ?></h5>
                                    <p class="text-muted small mb-2"><?= esc($book['author']) ?></p>
                                    <div class="mt-auto">
                                        <p class="h5 text-primary fw-bold mb-3">IDR <?= number_format($book['price'], 0, ',', '.') ?></p>
                                        <a href="<?= base_url('books/view/' . $book['id']) ?>" class="btn btn-dark w-100 rounded-pill">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h4>No books found.</h4>
                <a href="<?= base_url('books') ?>" class="btn btn-link">Show all books</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>