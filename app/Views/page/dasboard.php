<?= $this->extend('templates/index') ?>


<?= $this->section('content') ?>

<div class="row">
    <!-- Left Panel -->
    <div class="col-md-5 mb-4">
    <div class="card py-3 px-4 bg-gradient-primary text-white">
        <div class="card-body">
            <h4 class="font-weight-bold mb-2">Halo, <?= esc($username ?? 'User') ?></h4>
            <p class="mb-4">Anda memiliki <a href="#" class="text-white font-weight-bold"><?= $pengajuan ?> pengajuan</a></p>

            <div class="row text-center">
                <div class="col">
                    <div class="icon mb-1">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="h5"><?= $pengajuan ?></div>
                    <div class="small">Pengajuan</div>
                </div>
                <div class="col">
                    <div class="icon mb-1">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="h5"><?= $diproses ?></div>
                    <div class="small">Diproses</div>
                </div>
                <div class="col">
                    <div class="icon mb-1">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="h5"><?= $selesai ?></div>
                    <div class="small">Selesai</div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Right Panel -->
    <div class="col-md-7">
        <div class="card shadow p-4 bg-warning text-white">
            <h5 class="font-weight-bold mb-3">Notifikasi Pengaduan</h5>
            <ul class="list-unstyled">
                <li class="mb-3">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Laporan mengenai <strong>Fasilitas Rusak</strong> akan diproses maksimal <strong>3 hari kerja</strong>.
                </li>
                <li class="mb-3">
                    <i class="fas fa-shield-alt mr-2"></i> Pengaduan terkait <strong>Keamanan Kampus</strong> segera ditindaklanjuti dalam <strong>1 hari</strong>.
                </li>
                <li class="mb-3">
                    <i class="fas fa-broom mr-2"></i> Permintaan <strong>Kebersihan Area</strong> akan ditindaklanjuti dalam <strong>2 hari</strong>.
                </li>
                <li class="mb-3">
                    <i class="fas fa-concierge-bell mr-2"></i> Pengaduan tentang <strong>Pelayanan Akademik</strong> akan direspon dalam waktu <strong>maksimal 2 hari</strong>.
                </li>
                <li class="mb-0">
                    <i class="fas fa-check-circle mr-2"></i> Pastikan pengaduan Anda telah lengkap dan jelas agar dapat segera ditindaklanjuti.
                </li>
            </ul>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
