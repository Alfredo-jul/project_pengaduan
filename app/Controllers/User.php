<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function profile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $username = session()->get('username');

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/')->with('error', 'Data user tidak ditemukan.');
        }

        return view('page/profile', ['user' => $user]);
    }
    //edit profile
    public function edit()
    {
        $model = new \App\Models\UserModel();
        $user = $model->find(session()->get('id'));

        return view('page/edit_profile', ['user' => $user]);
    }
    //update profile
    public function update()
    {
        $model = new \App\Models\UserModel();
        $id = session()->get('id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = ['username' => $username];
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        session()->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to('/profile');
    }


    public function activityLog()
    {
        $model = new \App\Models\NotifikasiModel();

        $username = session()->get('username');
        $role = session()->get('role');

        $notifikasi = $model->where('username', $username)
                            ->orWhere('role', $role) // untuk admin
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

        // Update semua notifikasi yang belum dibaca jadi sudah_dibaca
        $model->where('username', $username)
            ->orWhere('role', $role)
            ->set(['status' => 'sudah_dibaca'])
            ->where('status', 'belum_dibaca')
            ->update();

        return view('page/activity_log', ['notifikasi' => $notifikasi]);
    }

}
