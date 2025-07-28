<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
        'h1' => 'Welcome Admin Unitomo',
        // 'nama' => 'Admin'
        ];
        return view('page/welcome',  $data);
        // return view('page/dasboard', $data);
    }

    public function index1(){
        $data = [
        'h1' => 'Welcome Mahasiswa Unitomo',
        // 'nama' => 'Mahasiswa'
        ];
        
        return view('page/welcome', $data);
        // return view('page/dasboard', $data);

    }

    public function index2(){
        $data = [
        'h1' => 'Welcome Dosen Unitomo',
        // 'nama' => 'Dosen'
        ];
       
        return view('page/welcome', $data);
        // return view('page/dasboard', $data);

    }
}
