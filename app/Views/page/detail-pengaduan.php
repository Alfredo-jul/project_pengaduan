<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2>Detail Pengaduan</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama:</strong> <?= esc($pengaduan['username']) ?></p>
            <p><strong>Tipe Pengaduan:</strong> <?= esc($pengaduan['tipe']) ?></p>
            <p><strong>Deskripsi:</strong><br><?= esc($pengaduan['deskripsi']) ?></p>
            <p><strong>Status:</strong> <?= esc($pengaduan['status']) ?></p>
            <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($pengaduan['created_at'])) ?></p>
            <p><strong>Foto:</strong><br>
                <?php if ($pengaduan['foto']): ?>
                    <img src="<?= base_url($pengaduan['foto']) ?>" alt="Foto" width="300">
                <?php else: ?>
                    <em>Tidak ada foto</em>
                <?php endif; ?>
            </p>
        </div>
    </div>

    <a href="<?= base_url('/pengajuan') ?>" class="btn btn-primary mt-3">Kembali</a>
</div>

<?= $this->endSection(); ?>
