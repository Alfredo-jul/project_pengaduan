<?= $this->extend('templates/index'); ?>

<?= $this->section('content')?>

        <div class="content fade-in-up">
            <!-- <h2>Pengajuan Pengaduan Baru</h2>
            <hr><br> -->

            <div class="form-box">
                <form method="post" action="<?= base_url('/pengaduan/simpan') ?>" enctype="multipart/form-data">
                    <label for="tipe">Tipe Pengaduan</label>
                    <select name="tipe" id="tipe" required>
                        <option value="">Pilih Tipe Pengaduan</option>
                        <option value="Fasilitas">Fasilitas</option>
                        <option value="Keamanan">Keamanan</option>
                        <option value="Kebersihan">Layanan</option>
                        
                    </select>

                    <!-- <label for="nama">Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required /> -->

                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" placeholder="Masukkan Deskripsi" required></textarea>

                    <label for="foto">Upload Foto</label>
                    <div class="row-upload">
                        <input type="file" name="foto" accept="image/*" required />
                    </div>
                   <button type="submit">SIMPAN</button>

                </form>
            </div>
        </div>
<?= $this->endSection()?> 