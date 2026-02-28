<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container py-4">
    <div class="row g-4">

        <!-- ===============================================================
             MAIN CONTENT - Book Details
        =============================================================== -->
        <div class="col-lg-8">
            <div class="card rounded-3 border shadow-sm">
                <div class="card-body p-4">
                    <div class="row">

                        <!-- Book Cover Image -->
                        <div class="col-md-4">
                            <div class="rounded d-flex align-items-center justify-content-center overflow-hidden bg-secondary" style="width: 100%; height: 400px;">
                                <?php if (!empty($book['img_url'])): ?>
                                    <img
                                        src="<?= base_url('uploads/books/' . esc($book['img_url'])) ?>"
                                        alt="<?= esc($book['title']) ?>"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;"
                                    >
                                <?php else: ?>
                                    <span class="text-white">No Cover</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Book Information -->
                        <div class="col-md-8">
                            <h2 class="mb-3 fw-bold"><?= esc($book['title']) ?></h2>

                            <!-- Author -->
                            <div class="mb-3">
                                <p class="mb-1"><strong>Author:</strong></p>
                                <p class="text-muted"><?= esc($book['author']) ?></p>
                            </div>

                            <!-- Publisher -->
                            <div class="mb-3">
                                <p class="mb-1"><strong>Publisher:</strong></p>
                                <p class="text-muted"><?= esc($book['publisher']) ?></p>
                            </div>

                            <!-- Release Date -->
                            <div class="mb-3">
                                <p class="mb-1"><strong>Release Date:</strong></p>
                                <p class="text-muted"><?= esc($book['release_date']) ?></p>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <p class="mb-1"><strong>Category:</strong></p>
                                <p class="text-muted">
                                    <?= !empty($book['category_name']) ? esc($book['category_name']) : '—' ?>
                                </p>
                            </div>

                            <!-- Synopsis -->
                            <div class="mb-3">
                                <p class="mb-1"><strong>Synopsis:</strong></p>
                                <p class="text-muted"><?= esc($book['sipnosis']) ?></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- ===============================================================
             SIDEBAR - Price & Add to Cart
        =============================================================== -->
        <div class="col-lg-4">
            <div class="card rounded-3 border shadow-sm">
                <div class="card-body p-4">

                    <!-- Price Display -->
                    <div class="mb-4">
                        <p class="text-muted mb-2">Price:</p>
                        <h3 class="text-dark fw-bold">IDR <?= number_format($book['price'], 0, ',', '.') ?></h3>
                    </div>

                    <!-- Add to Cart Button (Customer) -->
                    <?php if (session()->get('isLoggedIn') && !session()->get('isAdmin')): ?>
                        <form action="<?= base_url('cart/add') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                            <button type="submit" class="btn btn-dark w-100 py-2 rounded-2 fw-semibold">
                                Add to Cart
                            </button>
                        </form>

                    <!-- Disabled Button (Admin View) -->
                    <?php elseif (session()->get('isAdmin')): ?>
                        <button class="btn btn-secondary w-100 py-2 rounded-2 fw-semibold" disabled>
                            Admin View (No Cart)
                        </button>

                    <!-- Login Button (Guest) -->
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-dark w-100 py-2 rounded-2 fw-semibold">
                            Login to Add to Cart
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>