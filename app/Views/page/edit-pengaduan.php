<?= $this->extend('templates/index'); ?>


<?= $this->section('content'); ?>

<div class="container mt-4">
    <h2>Edit Pengaduan</h2>

    <form method="post" action="<?= base_url('/pengaduan/update/' . $pengaduan['id']) ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="tipe">Tipe Pengaduan</label>
            <select name="tipe" class="form-control" required>
                <option value="">-- Pilih Tipe Pengaduan --</option>
                <option value="Fasilitas" <?= $pengaduan['tipe'] == 'Fasilitas' ? 'selected' : '' ?>>Fasilitas</option>
                <option value="Keamanan" <?= $pengaduan['tipe'] == 'Keamanan' ? 'selected' : '' ?>>Keamanan</option>
                <option value="Kebersihan" <?= $pengaduan['tipe'] == 'Kebersihan' ? 'selected' : '' ?>>Kebersihan</option>
                <option value="Pelayanan" <?= $pengaduan['tipe'] == 'Pelayanan' ? 'selected' : '' ?>>Pelayanan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
             <input type="text" class="form-control" value="<?= session()->get('username') ?>" readonly>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required><?= esc($pengaduan['deskripsi']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label><br>
            <?php if (!empty($pengaduan['foto'])): ?>
                <img src="<?= base_url($pengaduan['foto']) ?>" alt="Foto Pengaduan" width="200" class="mb-2">
            <?php else: ?>
                <p><em>Tidak ada foto</em></p>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="foto">Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">
              Kosongkan jika tidak ingin mengganti foto.
            </small>

        </div>
       

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('/pengajuan') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection(); ?>
