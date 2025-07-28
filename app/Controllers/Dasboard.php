<?php

namespace App\Controllers;

class Dasboard extends BaseController
{
    public function indexAdmin()
    {
        $data = [
            'nama' => 'Admin',
            'username' => session()->get('username')
        ];
        return view('page/dasboard', $data);
    }

    public function indexMahasiswa()
    {
        $data = [
            'nama' => 'Mahasiswa',
            'username' => session()->get('username')
        ];
        return view('page/dasboard', $data);
    }

    public function indexDosen()
    {
        $data = [
            'nama' => 'Dosen',
            'username' => session()->get('username')
        ];
        return view('page/dasboard', $data);
    }

    public function dashboard()
    {
        $model = new \App\Models\PengaduanModel();
        $role = session()->get('role');
        $nama = session()->get('nama'); // Pastikan 'nama' tersimpan di session
        $username = session()->get('username'); 
        
        if ($role === 'admin') {
            // $total = $model->countAllResults();
            $pengajuan = $model->where('status', 'pengajuan')->countAllResults();
            $model->resetQuery();
            $diproses = $model->where('status', 'diproses')->countAllResults();
            $model->resetQuery();
            $selesai = $model->where('status', 'selesai')->countAllResults();
        } else {
            // $total = $model->where('username', $username)->countAllResults();
            $pengajuan = $model->where('status', 'pengajuan')->countAllResults();
            $model->resetQuery();
            $diproses = $model->where('username', $username)->where('status', 'diproses')->countAllResults();
            $model->resetQuery();
            $selesai = $model->where('username', $username)->where('status', 'selesai')->countAllResults();
        }

        $data = [
            'username' => $username,
            'nama' => $nama,
            'role' => $role,
            'pengajuan' => $pengajuan,
            // 'total' => $total,
            'diproses' => $diproses,
            'selesai' => $selesai
        ];

        return view('page/dasboard', $data);
    }

}