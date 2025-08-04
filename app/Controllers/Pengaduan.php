<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\NotifikasiModel;

class Pengaduan extends BaseController
{
    // Menampilkan form tambah pengaduan
    public function tambah()
    {
        return view('page/tambah-pengaduan');
    }


    public function pengajuan()
   {

        $model = new PengaduanModel();
        $session = session();
        $role = $session->get('role');
        $username = $session->get('username');

        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        // Mulai query builder
        if ($role == 'admin') {
            $model->orderBy('created_at', 'DESC');
        } else {
            $model->where('username', $username)
                ->orderBy('created_at', 'DESC');
        }

        // Filter bulan & tahun
        if ($bulan) {
            $model->where('MONTH(created_at)', $bulan);
        }
        if ($tahun) {
            $model->where('YEAR(created_at)', $tahun);
        }

        $data['data'] = $model->findAll();

        return view('page/tabel', $data);

//         $model = new PengaduanModel();
//         $session = session();
//         $role = $session->get('role');
//         $username = $session->get('username');
//         $data['data'] = $model->findAll(); // Ini sudah otomatis menyertakan 'id' jika modelnya benar

//         $bulan = $this->request->getGet('bulan');
//         $tahun = $this->request->getGet('tahun');


//         if ($bulan && $tahun) {
//             $model->where('MONTH(created_at)', $bulan)
//                 ->where('YEAR(created_at)', $tahun);
//         } elseif ($bulan) {
//             $model->where('MONTH(created_at)', $bulan);
//         } elseif ($tahun) {
//             $model->where('YEAR(created_at)', $tahun);
//         }

//         $data = $model->findAll();

//         if ($role == 'admin') {
//             // Admin melihat semua pengajuan
//             $data['data'] = $model->orderBy('created_at', 'DESC')->findAll();
//         } else {
//             // User hanya melihat pengaduan miliknya (berdasarkan username/nama yang tersimpan)
//             $data['data'] = $model->where('username', $username)->orderBy('created_at', 'DESC')->findAll();
//         }

//         return view('page/tabel', $data); // tampilkan ke tabel
//    }
    }




    // Menyimpan data pengaduan
    public function simpan()
    {
        $model = new PengaduanModel();
        $session = session();
        $username = $session->get('username');

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $path = 'uploads/' . $newName;
        } else {
            return redirect()->back()->with('error', 'Gagal upload foto');
        }

        $data = [
            'tipe'      => $this->request->getPost('tipe'),
            // 'nama'      => $this->request->getPost('nama'),
            'username'  => $username,
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto'      => $path,
            'status'    => 'pengajuan',
        ];

        $model->insert($data);

        // ✅ Tambahkan notifikasi ke admin
        $notifModel = new NotifikasiModel();
        $notifModel->save([
            'username' => $username,
            'role'     => 'admin',
            'isi'      => 'Pengaduan baru dari ' . $username,
            'status'   => 'belum_dibaca'
        ]);

        return redirect()->to('/pengajuan')->with('success', 'Pengaduan berhasil dikirim!');
    }



    // Form edit status
    public function editStatus($id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $model = new PengaduanModel();
        $data['pengaduan'] = $model->find($id);
        return view('page/edit-status', $data);
    }

    // Proses update status
    public function updateStatus($id)
    {
        $session = session();
        if ($session->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $statusBaru = $this->request->getPost('status');

        // Validasi status sesuai ENUM
        $enumStatus = ['pengajuan', 'diproses', 'selesai'];
        if (!in_array($statusBaru, $enumStatus)) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $model = new PengaduanModel();
        $model->update($id, ['status' => $statusBaru]);

        // Ambil data pengaduan untuk mengetahui user_id / nama pengirim
        $pengaduan = $model->find($id);

        // Simpan notifikasi untuk user yang bersangkutan
        $notifModel = new NotifikasiModel();
        $notifModel->save([
            'username' => $pengaduan['username'], // pastikan field ini ada di tabel pengaduan
            'role' => $pengaduan['role'] ?? 'mahasiswa', // jika role disimpan, gunakan ini
            'isi' => 'Status pengaduan Anda telah diperbarui menjadi: ' . $statusBaru,
            'status' => 'belum_dibaca'
        ]);

        $session->setFlashdata('success', 'Status pengaduan berhasil diperbarui');
        return redirect()->to('/pengajuan')->with('success', 'Status berhasil diperbarui');
    }



// Form edit pengaduan
    public function edit($id)
    {
        $session = session();
        $role = $session->get('role');
        $username = $session->get('username');

        if (!in_array($role, ['mahasiswa', 'dosen'])) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $model = new PengaduanModel();
        // $data['pengaduan'] = $model->find($id);
        $pengaduan = $model->find($id);

         if (!$pengaduan) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Hanya boleh diedit jika milik sendiri & status = pengajuan
        if ($pengaduan['username'] !== $username || $pengaduan['status'] !== 'pengajuan') {
            return redirect()->back()->with('error', 'Anda hanya dapat mengedit pengaduan dengan status pengajuan');
        }
        
        return view('page/edit-pengaduan', ['pengaduan' => $pengaduan]);
    }

// Form update pengaduan
    public function update($id)
    {
        $session = session();
        $role = $session->get('role');
        $username = $session->get('username');

        if (!in_array($role, ['mahasiswa', 'dosen'])) {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $model = new PengaduanModel();
        // $data['pengaduan'] = $model->find($id);
        $pengaduan = $model->find($id);

        if (!$pengaduan) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Hanya boleh diedit jika milik sendiri & status = pengajuan
        if ($pengaduan['username'] !== $username || $pengaduan['status'] !== 'pengajuan') {
            return redirect()->back()->with('error', 'Anda hanya dapat mengedit pengaduan dengan status pengajuan');
        }

        // Ambil data input
        $data = [
            'tipe'      => $this->request->getPost('tipe'),
            'username'  => session()->get('username'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        // Cek apakah user mengupload file foto baru
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Hapus foto lama terlebih dahulu
            if (!empty($pengaduan['foto']) && file_exists($pengaduan['foto'])) {
            unlink($pengaduan['foto']);
            }

            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            $data['foto'] = 'uploads/' . $newName;
        }

        // Simpan ke database
        $model->update($id, $data);

        $session->setFlashdata('success', 'Pengaduan berhasil diperbarui');
        return redirect()->to('/pengajuan')->with('success', 'Pengaduan berhasil diubah!');
    }


    // Detail pengaduan
    public function detail($id)
    {
        $model = new PengaduanModel();
        $pengaduan = $model->find($id);

        if (!$pengaduan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        return view('page/detail-pengaduan', ['pengaduan' => $pengaduan]);
    }

    // Hapus pengaduan
    public function hapus($id)
    {
        $model = new PengaduanModel();
        $pengaduan = $model->find($id);

        if (!$pengaduan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Hapus file foto jika ada
        if (!empty($pengaduan['foto']) && file_exists($pengaduan['foto'])) {
            unlink($pengaduan['foto']);
        }

        $model->delete($id);
        return redirect()->to('/pengajuan')->with('success', 'Pengaduan berhasil dihapus!');
    }


}
