<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/pengunjung', 'Pengunjung::index');
$routes->get('/pengunjung/test', 'Pengunjung::test');
//Login
$routes->group('',['filter'=>'logins'], static function($routes){
    $routes->get('/login', 'Login::index');
    $routes->post('/login/cekUser', 'Login::cekUser');
    $routes->get('/login/register', 'Register::index');
    $routes->post('/login/register/cekRegis', 'Register::cekRegis');
    $routes->get('/login/forgot', 'Forgot::index');
    $routes->post('/login/forgot/cekEmail', 'Forgot::cekEmail');
});
$routes->get('/login/keluar', 'Login::keluar');
$routes->group('',['filter'=>'member'], static function($routes){
    //dashbboardMember
    $routes->get('/dashboard/profile', 'Kelolaprofile::index');
    $routes->get('/dashboard/veriflanjut', 'Veriflanjut::index');
    $routes->post('/dashboard/veriflanjut/kirim', 'Veriflanjut::kirim');
});

    
//tempalte
// $routes->group('',['filter'=>'login'], static function($routes){
    
// });

//dashboardAdmin
$routes->get('/login/coba', 'Coba::index');
$routes->post('/login/coba/cekXendit', 'Coba::cekXendit');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/kelolamember', 'Kelolamember::index');
$routes->post('/dashboard/kelolamember/hapus', 'Kelolamember::hapus');
$routes->get('/admin/veriflanjut', 'Veriflanjut::list');
$routes->get('/admin/veriflanjut/(:segment)', 'Veriflanjut::detail/$1');
$routes->get('/admin/veriflanjut/cekrekening', 'Veriflanjut::cekrekening');
$routes->post('/admin/veriflanjut/terima', 'Veriflanjut::terima');
$routes->post('/admin/veriflanjut/tolak', 'Veriflanjut::tolak');

//filterverified dulu
$routes->group('',['filter'=>'verified'], static function($routes){
    $routes->get('/dashboard/kelolahewan', 'Kelolahewan::index');
    $routes->post('/dashboard/kelolahewan/hapus', 'Kelolahewan::hapus');
    $routes->get('/dashboard/kelolahewan/tambah', 'Kelolahewan::tambah');
    $routes->get('/dashboard/kelolahewan/edit', 'Kelolahewan::edit');
    $routes->post('/dashboard/kelolahewan/edit', 'Kelolahewan::edit');
    $routes->post('/dashboard/kelolahewan/upload', 'Kelolahewan::upload');
    
    //adopsi
    $routes->get('/dashboard/kelolaadopsi', 'Kelolaadopsi::index');
    $routes->get('/dashboard/kelolaadopsi/detail', 'Kelolaadopsi::detail');
    $routes->get('/dashboard/kelolaadopsi/orang', 'Kelolaadopsi::orang');
    $routes->get('/dashboard/kelolaadopsi/orang/(:segment)', 'Kelolaadopsi::detailorang/$1');
    $routes->post('/dashboard/kelolaadopsi/orang/terima', 'Kelolaadopsi::terimaCalon');
    $routes->post('/dashboard/kelolaadopsi/orang/tolak', 'Kelolaadopsi::tolakCalon');
    $routes->get('/dashboard/kelolaadopsi/pengajuan', 'Kelolaadopsi::pengajuan');
    $routes->get('/dashboard/kelolaadopsi/pengajuan/(:segment)', 'Kelolaadopsi::detailpengajuan/$1');
    $routes->post('/dashboard/kelolaadopsi/pengajuan/terima', 'Kelolaadopsi::terimapengajuan');
    $routes->post('/dashboard/kelolaadopsi/pengajuan', 'Kelolaadopsi::pengajuan');
    $routes->post('/pasar/ajukanadopsi', 'Pasar::ajukanadopsi');
    
    //transaksi
    $routes->get('/dashboard/kelolatransaksi/buattransaksi', 'Kelolatransaksi::buattransaksi');
    $routes->post('/dashboard/kelolatransaksi/buatVA', 'Kelolatransaksi::buatVA');
    $routes->post('/dashboard/kelolatransaksi/cekPembayaran', 'Kelolatransaksi::cekPembayaran');
//group test
});


//pasar
$routes->get('/pasar', 'Pasar::index');
$routes->get('/pasar/(:segment)', 'Pasar::detail/$1');




$routes->group('',['filter'=>'verified'], static function($routes){
    $routes->get('/testingpage', 'Kelolatransaksi::databayar');
    $routes->get('/simulasibayar', 'Simulasibayar::simulasiBayar');//ignore, gagal
    
});
$routes->get('/simulasibayar/kirim', 'Simulasibayar::simulasiBayarKirim'); //gagal


//testing




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
