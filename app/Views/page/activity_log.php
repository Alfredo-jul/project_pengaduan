<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Activity Log</h4>

<ul class="list-group">
    <?php foreach ($notifikasi as $n): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= esc(strip_tags($n['isi'])) ?>
            <span class="badge badge-<?= $n['status'] === 'belum_dibaca' ? 'warning' : 'success' ?>">
                <?= $n['status'] === 'belum_dibaca' ? 'Belum Dibaca' : 'Sudah Dibaca' ?>
            </span>
        </li>
    <?php endforeach; ?>
</ul>

<?= $this->endSection() ?>
