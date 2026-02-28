<?= $this->extend('base') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row g-4">
        <!-- Left Side - Cart Items -->
        <div class="col-lg-8">
            <div class="card baorder-0 shadow rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="mb-1 fw-bold"><?= $username ?>`s Cart</h3>
                            <!-- <p class="text-muted mb-0 small" id="itemCount">2 items in your cart</p> -->
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label small" for="selectAll">Select All</label>
                            </div>
                            <button class="btn btn-danger btn-sm px-3" type="button" id="deleteSelected">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill me-1" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Cart Items -->
                    <div id="cartItems">
                        <!-- Book Item 1 -->
                        <?php if (!empty($cartItem) && is_array($cartItem)) { ?>
                            <?php foreach ($cartItem as $item) { ?>
                                <div class="cart-item mb-3" data-item-id="<?= $item['id'] ?>">
                                    <div class="d-flex gap-3 p-3 bg-light rounded-3 align-items-center">
                                        <div class="flex-shrink-0">
                                            <input class="form-check-input item-checkbox" type="checkbox" style="width:20px;height:20px;">
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="bg-secondary rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width:80px;height:110px;">
                                                <span class="text-white text-center small">Cover</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1 fw-bold"><?= $item['title'] ?></h5>
                                            <p class="text-muted mb-2 small"><?= $item['author'] ?></p>
                                            <p class="fw-bold text-primary mb-0 fs-5 item-price">IDR <?= $item['total_price'] ?></p>
                                        </div>
                                        <!-- Quantity Controls -->
                                        <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                            <button class="btn btn-outline-secondary qty-minus d-flex align-items-center justify-content-center fw-bold fs-5" type="button" style="width:32px;height:32px;padding:0;">−</button>
                                            <span class="qty-display fw-bold text-center" style="min-width:32px;"><?= $item['quantity'] ?></span>
                                            <button class="btn btn-outline-primary qty-plus d-yflex align-items-center justify-content-center fw-bold fs-5" type="button" style="width:32px;height:32px;padding:0;">+</button>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-danger delete-item d-flex align-items-center justify-content-center" type="button" style="width:36px;height:36px;padding:0;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <h5 class="text-center fw-bold">No Items in cart</h5>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Order Summary -->
        <div class="col-lg-4">
            <div class="card border-0 shadow rounded-4 position-sticky" style="top:20px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Cart Summary</h4>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Items</span>
                            <span class="fw-semibold" id="summaryItemCount"><?= $cart['total_item']?? 0 ?> items</span>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold mb-0">Total</h5>
                        <h5 class="fw-bold mb-0 text-primary" id="summaryTotal">IDR <?= $cart['total'] ?? 0 ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('cartItems').addEventListener('click', function(e) {
        const btn = e.target.closest('.qty-minus, .qty-plus, .delete-item');
        if (!btn) return;

        const item = btn.closest('.cart-item');
        const itemId = item.dataset.itemId;
        const qtyDisplay = item.querySelector('.qty-display');
        const priceDisplay = item.querySelector('.item-price');

        if (btn.classList.contains('delete-item')) {
            if (!confirm('Are you sure you want to remove this item?')) return;

            btn.disabled = true;
            btn.style.opacity = '0.5';

            fetch('<?= base_url("cart/delete-item") ?>', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        item.remove();
                        updateCartSummary();

                        if (document.querySelectorAll('.cart-item').length === 0) {
                            location.reload();
                        }
                    } else {
                        alert('Failed to delete item');
                        btn.disabled = false;
                        btn.style.opacity = '1';
                    }
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                });
            return;
        }

        let currentQty = parseInt(qtyDisplay.textContent);
        let newQty = currentQty;

        if (btn.classList.contains('qty-plus')) {
            newQty = currentQty + 1;
        } else if (btn.classList.contains('qty-minus') && currentQty > 1) {
            newQty = currentQty - 1;
        } else {
            return;
        }

        const originalPrice = priceDisplay.textContent;

        qtyDisplay.textContent = newQty;
        btn.disabled = true;
        btn.style.opacity = '0.5';

        fetch('<?= base_url("cart/update-quantity") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    item_id: itemId,
                    quantity: newQty
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.new_price) {
                        priceDisplay.textContent = 'IDR ' + data.new_price;
                    }
                    updateCartSummary();
                } else {
                    qtyDisplay.textContent = currentQty;
                    priceDisplay.textContent = originalPrice;
                }
            })
            .finally(() => {
                btn.disabled = false;
                btn.style.opacity = '1';
            });
    });

    document.getElementById('deleteSelected').addEventListener('click', function() {
        const checkedItems = document.querySelectorAll('.item-checkbox:checked');

        if (checkedItems.length === 0) {
            alert('Please select items to delete');
            return;
        }

        if (!confirm(`Delete ${checkedItems.length} selected item(s)?`)) return;

        const itemIds = [];
        checkedItems.forEach(cb => {
            const itemId = cb.closest('.cart-item').dataset.itemId;
            if (itemId) itemIds.push(itemId);
        });

        const btn = this;
        btn.disabled = true;
        btn.style.opacity = '0.5';

        fetch('<?= base_url("cart/delete-selected") ?>', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    item_ids: itemIds
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    checkedItems.forEach(cb => {
                        cb.closest('.cart-item').remove();
                    });

                    document.getElementById('selectAll').checked = false;

                    updateCartSummary();

                    if (document.querySelectorAll('.cart-item').length === 0) {
                        location.reload();
                    }
                } else {
                    alert('Failed to delete selected items');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.style.opacity = '1';
            });
    });

    document.getElementById('selectAll').addEventListener('change', function() {
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
    });

    function updateCartSummary() {
        fetch('<?= base_url("cart/get-summary") ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('summaryItemCount').textContent =
                        data.total_item + ' item' + (data.total_item !== 1 ? 's' : '');
                    document.getElementById('summaryTotal').textContent =
                        'IDR ' + data.total
                }
            });
    }
</script>

<?= $this->endSection() ?>