<?php

use CodeIgniter\Router\RouteCollection;




/**
 * @var RouteCollection $routes
 */
  //route dasboard
  $routes->get('/dasboard', 'Dasboard::dashboard');
  $routes->get('/admin', 'Dasboard::indexAdmin');
  $routes->get('/mahasiswa', 'Dasboard::indexMahasiswa');
  $routes->get('/dosen', 'Dasboard::indexDosen');
  $routes->get('/activity-log', 'User::activityLog');

  //route login
  $routes->get('/login', 'Login::index1');
  $routes->post('/loginauth', 'Login::auth');
  $routes->post('/registerauth', 'Login::register');
  $routes->get('/register', 'Login::index2');
  $routes->get('/forgot', 'Login::index3');
  $routes->get('/profile', 'User::profile');
  $routes->get('/profile/edit', 'User::edit');      // Form edit
$routes->post('/profile/update', 'User::update'); // Proses update

  //route pengaduan
  $routes->get('/pengaduan/tambah', 'Pengaduan::tambah');
  $routes->post('/pengaduan/simpan', 'Pengaduan::simpan');
  $routes->get('/pengajuan', 'Pengaduan::pengajuan');

  //route admin
  // $routes->get('/pengaduan/edit-status/(:num)', 'Pengaduan::editStatus/$1');
  $routes->post('/pengaduan/update-status/(:num)', 'Pengaduan::updateStatus/$1');
  $routes->get('/pengaduan/detail/(:num)', 'Pengaduan::detail/$1');

  //route selain admin
  $routes->get('/pengaduan/edit/(:num)', 'Pengaduan::edit/$1');
  $routes->post('/pengaduan/update/(:num)', 'Pengaduan::update/$1');
  $routes->get('/pengaduan/hapus/(:num)', 'Pengaduan::hapus/$1');





  // $routes->get('/product/(:alpha)', 'Product::detail_merek/$1', ['as' => 'detailproduct']);
// $routes->get('/product/(:alpha)/(:alphanum)', 'Product::detail_model/$1/$2');
// $routes->get('/product/(:alpha)/(:alphanum)/(:num)', 'Product::detail_jumlah/$1/$2/$3');
