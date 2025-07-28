<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>


<div class="container mt-4">
    <h2>Edit Profil</h2>

    <div class="card shadow p-4">
        <form action="<?= base_url('/profile/update') ?>" method="post">
            <div class="form-group">
                <label for="username">Username Baru</label>
                <input type="text" class="form-control" name="username" value="<?= esc($user['username']) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengganti">
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/profile') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
