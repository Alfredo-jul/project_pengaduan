<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotifikasiModel;


class Login extends BaseController
{
    // halaman login
    public function index1()
    {
       return view('page/login');
    }

    // halaman register
    public function index2()
    {

       return view('page/register');
    }


    // halaman forgot-password
    public function index3()
    {
       return view('page/forgot-password');
    }


    // autentikasi login
    public function auth()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // Cek password (asumsi menggunakan password hash)
            if ($password == $user['password']) {
                // if (password_verify($password, $user['password'])) {
                $data = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                    'logged_in' => true
                ];
                $session->set($data);

                // Arahkan sesuai role
                if ($user['role'] == 'admin') {
                    // return redirect()->to('/admin');
                    $session->setFlashdata('success', 'Berhasil login sebagai ' . $user['role']);
                    return redirect()->to('/dasboard');
                } else if($user['role'] == 'dosen') {
                    $session->setFlashdata('success', 'Berhasil login sebagai ' . $user['role']);
                    return redirect()->to('/dasboard');
                    // return redirect()->to('/dosen');
                } else {
                    $session->setFlashdata('success', 'Berhasil login sebagai ' . $user['role']);
                    return redirect()->to('/dasboard');
                    // return redirect()->to('/mahasiswa');
                }

            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }


    // resister
    public function register()
    {
        $model = new UserModel();
        // $session = session();

        $nim = $this->request->getPost('nim');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');
        $role     = $this->request->getPost('role'); // default: 'mahasiswa', 'admin', dll.

         // Validasi sederhana
        if (empty($nim) || empty($username) || empty($password) || empty($password_confirm) || empty($role)) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        if ($password !== $password_confirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
        }

        // Cek apakah username atau NIM sudah digunakan
        if ($model->where('username', $username)->orWhere('nim', $nim)->first()) {
            return redirect()->back()->with('error', 'NIM atau Username sudah digunakan.');
        }

        // Simpan user baru (tanpa hash, atau bisa aktifkan hash-nya di bawah)
        $data = [
            'nim'      => $nim,
            'username' => $username,
            'password' => $password, // Untuk keamanan sebaiknya di-hash
            'role'     => $role
        ];

        // Jika ingin pakai hash (aktifkan ini dan ubah juga auth())
        // $data['password'] = password_hash($password, PASSWORD_DEFAULT);

        $model->insert($data);

            // Tambah notifikasi untuk admin
            $notifModel = new NotifikasiModel();
            $notifModel->save([
                'username' => $data['username'],
                'role'     => 'admin',
                'isi'      => 'Akun baru telah mendaftar dengan username: ' . $data['username'],
                'status'   => 'belum_dibaca'
            ]);


        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


}
