<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ubah Status Pengaduan</h2>
    <form method="post" action="<?= base_url('/pengaduan/update-status/' . $pengaduan['id']) ?>">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="diproses" <?= $pengaduan['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                <option value="selesai" <?= $pengaduan['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>

<?= $this->endSection() ?>
