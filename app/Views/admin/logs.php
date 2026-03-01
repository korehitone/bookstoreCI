<?= $this->extend('admin/base') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card border-0 shadow rounded-4">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Activity Logs</h2>
                    <p class="text-muted mb-0">View all administrator activities</p>
                </div>
                <!-- Date Sort Toggle -->
                <a href="<?= base_url('admin/logs?order=' . ($order === 'DESC' ? 'ASC' : 'DESC') . (!empty($keyword) ? '&keyword=' . $keyword : '')) ?>"
                    class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-arrow-<?= $order === 'DESC' ? 'down' : 'up' ?>"></i>
                    <?= $order === 'DESC' ? 'Newest First' : 'Oldest First' ?>
                </a>
            </div>

            <!-- Search Bar -->
            <form method="get" action="<?= base_url('admin/logs') ?>" class="mb-4">
                <div class="input-group">
                    <input type="search" name="keyword" class="form-control"
                        placeholder="Search logs..." value="<?= esc($keyword) ?>">
                    <input type="hidden" name="order" value="<?= $order ?>">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <?php if ($keyword): ?>
                        <a href="<?= base_url('admin/logs?order=' . $order) ?>"
                            class="btn btn-outline-danger">Clear</a>
                    <?php endif; ?>
                </div>
            </form>

            <!-- Logs Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Admin</th>
                            <th>Action</th>
                            <th>Table</th>
                            <th>Record</th>
                            <th>Details</th>
                            <th>
                                <a href="<?= base_url('admin/logs?order=' . ($order === 'DESC' ? 'ASC' : 'DESC') . (!empty($keyword) ? '&keyword=' . $keyword : '')) ?>"
                                    class="text-dark text-decoration-none">
                                    Date <?= $order === 'DESC' ? '↓' : '↑' ?>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($logs)): ?>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td>
                                        <?= esc($log['username']) ?><br>
                                        <small class="text-muted"><?= esc($log['email']) ?></small>
                                    </td>
                                    <td>
                                        <?php
                                        $badge = match ($log['action']) {
                                            'CREATE' => 'bg-success',
                                            'UPDATE' => 'bg-warning text-dark',
                                            'DELETE' => 'bg-danger',
                                            'LOGIN'  => 'bg-info text-dark',
                                            default  => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?= $badge ?>"><?= $log['action'] ?></span>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?= $log['table_name'] ?></span></td>
                                    <td>#<?= $log['record_id'] ?></td>
                                    <td style="max-width: 250px;">
                                        <?php if ($log['details']): ?>

                                            <?php
                                            // Debug - remove after testing
                                            // var_dump(gettype($log['details'])); 

                                            $detailsStr = is_string($log['details']) ? $log['details'] : print_r($log['details'], true);
                                            ?>
                                            <span class="text-muted small" title="<?= esc($detailsStr) ?>">
                                                <?= esc(substr($detailsStr, 0, 50)) ?>...
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($log['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No logs found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($pager): ?>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?>
                    </div>
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>