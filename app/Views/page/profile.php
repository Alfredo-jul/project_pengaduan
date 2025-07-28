<?= $this->extend('templates/index') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Profil Saya</h2>

    <!-- Informasi Profil -->
    <div class="card shadow p-4 mb-4">
        <h5 class="mb-3 text-primary">Informasi Akun</h5>
        <table class="table table-borderless">
            <tr>
                <th>NIM</th>
                <td><?= esc($user['nim']) ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?= esc($user['username']) ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><span class="badge badge-info"><?= esc($user['role']) ?></span></td>
            </tr>
        </table>

        <!-- Tombol Aksi -->
        <div class="mt-3 d-flex justify-content-between">
            <a href="<?= base_url('/dasboard') ?>" class="btn btn-secondary">Kembali</a>
            <a href="<?= base_url('/profile/edit') ?>" class="btn btn-primary">Edit Profil</a>
        </div>
    </div>
</div>



<?= $this->endSection() ?>
