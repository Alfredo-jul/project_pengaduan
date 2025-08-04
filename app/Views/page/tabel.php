<?= $this->extend('templates/index'); ?>

<?php $role = session()->get('role'); ?>


<?= $this->section('content')?>

<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaduan</h6>
                        </div>
                        <div class="card-body">
                          

                            <form method="get" class="form-inline mb-3">
                                <label for="bulan" class="mr-2">Filter Bulan:</label>
                                <select name="bulan" id="bulan" class="form-control mr-3">
                                    <option value="">Semua Bulan</option>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <?php $selected = ($i == (int)($_GET['bulan'] ?? '')) ? 'selected' : ''; ?>
                                        <option value="<?= $i ?>" <?= $selected ?>><?= date('F', mktime(0, 0, 0, $i, 10)) ?></option>
                                    <?php endfor; ?>
                                </select>

                                <label for="tahun" class="mr-2">Tahun:</label>
                                <select name="tahun" id="tahun" class="form-control mr-3">
                                    <option value="">Semua Tahun</option>
                                    <?php
                                        $currentYear = date('Y');
                                        for ($y = $currentYear; $y >= 2020; $y--): // Ganti 2020 sesuai kebutuhan
                                            $selected = ($y == ($_GET['tahun'] ?? '')) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $y ?>" <?= $selected ?>><?= $y ?></option>
                                    <?php endfor; ?>
                                </select>

                                <button type="submit" class="btn btn-primary">Terapkan</button>
                                
                                
                                    <div>
                                        <?php
                                            if ($role === 'mahasiswa' || $role === 'dosen'):
                                        ?>
                                            <a href="<?= base_url('/pengaduan/tambah'); ?>">
                                                <button class="btn btn-primary">TAMBAH</button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                               

                            </form>

                          
                            <div class="table-responsive">

                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="bg-gradient-primary text-white">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Keterangan</th>
                                            <th>Pengaduan</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($data as $i => $d): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= esc($d['username']) ?></td>
                                            <td><?= esc($d['deskripsi']) ?></td> 
                                            <td><?= esc($d['tipe']) ?></td>
                                            <td><?= date('d-m-Y H:i', strtotime($d['created_at'])) ?></td>
                                            <td>
                                                <?php
                                                    $status = strtolower($d['status']);
                                                    $kelas = 'badge ';
                                                    if ($status === 'selesai') $kelas .= 'green';
                                                    elseif ($status === 'diproses') $kelas .= 'red';
                                                    elseif ($status === 'pengajuan') $kelas .= 'orange';
                                                    else $kelas .= 'gray';
                                                ?>
                                                <span class="<?= $kelas ?>"><?= ucfirst($status) ?></span>

                                                <div class="dropdown aksi-wrapper">
                                                    <button class="aksi">Aksi <i class="fas fa-chevron-down"></i></button>
                                                    <div class="dropdown-content">

                                                        <a href="<?= base_url('/pengaduan/detail/' . $d['id']) ?>"><i class="fas fa-eye"></i> Detail</a>
                                                        
                                                    <?php if ($role === 'admin'): ?>

                                                        <!-- Tombol di tabel pengajuan untuk admin -->
                                                        <a href="#" data-toggle="modal" data-target="#ubahStatusModal<?= $d['id'] ?>">
                                                            <i class="fas fa-edit"></i> Ubah Status
                                                        </a>

                                                        <a href="<?= base_url('/pengaduan/hapus/' . $d['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>

                                                    <?php elseif ($role === 'mahasiswa' || $role === 'dosen'): ?>
                                                            
                                                        <a href="<?= base_url('/pengaduan/edit/' . $d['id']) ?>"><i class="fas fa-edit"></i> Edit</a>
                                                        
                                                    <?php endif; ?>

                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal untuk ubah status -->
                                        <div class="modal fade" id="ubahStatusModal<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="ubahStatusLabel<?= $d['id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="<?= base_url('/pengaduan/update-status/' . $d['id']) ?>" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="ubahStatusLabel<?= $d['id'] ?>">Ubah Status Pengaduan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status">Status Baru</label>
                                                        <select name="status" class="form-control" required>
                                                        <option value="diproses" <?= $d['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                                        <option value="selesai" <?= $d['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>

                                      <?php endforeach; ?>
                                    </tbody>
                                </table>

                                

                            </div>
                        </div>
                    </div>

<?= $this->endSection()?> 
