<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    // Routes for Nasabah API
    $routes->get('nasabah', 'Nasabah::index');
    $routes->post('nasabah', 'Nasabah::create');
    $routes->get('nasabah/(:num)', 'Nasabah::show/$1');
    $routes->post('nasabah/(:num)', 'Nasabah::update/$1');
    $routes->delete('nasabah/(:num)', 'Nasabah::delete/$1');
});
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    // Routes for Pengguna API
    $routes->get('pengguna', 'Pengguna::index');
    $routes->post('pengguna', 'Pengguna::create');
    $routes->get('pengguna/(:num)', 'Pengguna::show/$1');
    $routes->post('pengguna/(:num)', 'Pengguna::update/$1');
    $routes->delete('pengguna/(:num)', 'Pengguna::delete/$1');
});
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('bayar', 'BayarController::index');
    $routes->get('bayar/(:num)', 'BayarController::readByKodePP/$1');
    $routes->post('bayar/(:num)', 'BayarController::create/$1');
    $routes->get('bayar/status/(:num)/(:alphanum)', 'BayarController::updateStatus/$1/$2');
    $routes->put('bayar/(:num)', 'BayarController::update/$1');
    $routes->delete('bayar/(:num)', 'BayarController::delete/$1');
});

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('pengajuan-peminjaman', 'PengajuanPeminjamanController::create');
    $routes->get('pengajuan-peminjaman', 'PengajuanPeminjamanController::index');
    $routes->get('pengajuan-peminjaman/(:num)', 'PengajuanPeminjamanController::show/$1');
    $routes->post('pengajuan-peminjaman/(:num)', 'PengajuanPeminjamanController::update/$1');
    $routes->post('pengajuan-peminjaman/(:num)/delete', 'PengajuanPeminjamanController::delete/$1');
    $routes->get('pengajuan-pinjaman/by-kode-nasabah/(:segment)', 'PengajuanPeminjamanController::getByKodeNasabah/$1');

    $routes->get('pinjaman', 'PinjamanController::index');
    $routes->get('pinjaman/(:segment)', 'PinjamanController::show/$1');
    $routes->post('pinjaman', 'PinjamanController::create');
    $routes->post('pinjaman/(:segment)', 'PinjamanController::update/$1');
    $routes->delete('pinjaman/(:segment)', 'PinjamanController::delete/$1');

    $routes->post('login', 'AuthController::login');

    $routes->post('pengajuan-nasabah/create', 'Nasabah::createPengajuan');

    $routes->post('update-pengajuan/(:segment)', 'PengajuanPeminjamanController::updateStatus/$1');
    $routes->get('summary', 'ApiController::getSummaryData');

});
