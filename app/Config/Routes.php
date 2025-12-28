<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inform', 'PageController::inform');
$routes->get('/about', 'PageController::about');
$routes->get('/alur', 'PageController::alur');
$routes->get('/perawatan', 'PageController::perawatan');
$routes->get('/laporan', 'PageController::laporan');

$routes->get('/inventory', 'InventoryController::index');
$routes->get('/inventory/(:num)', 'InventoryController::detail/$1');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->group('pekerjaan', ['filter' => 'authGuard'], function($routes){
    $routes->get('/', 'PekerjaanController::index');
    $routes->get('create', 'PekerjaanController::create');
    $routes->post('save', 'PekerjaanController::save');
    $routes->get('edit/(:num)', 'PekerjaanController::edit/$1');
    $routes->post('update/(:num)', 'PekerjaanController::update/$1');
    $routes->get('delete/(:num)', 'PekerjaanController::delete/$1');
    $routes->get('delete/(:num)', 'PekerjaanController::delete/$1');
    
});

// Barang dan Barang Log Routes
$routes->group('barang', ['filter' => 'authGuard'], function($routes){
    $routes->get('/', 'BarangController::index');
    $routes->get('create', 'BarangController::create');
    $routes->post('save', 'BarangController::save');
    $routes->get('edit/(:num)', 'BarangController::edit/$1');
    $routes->post('update/(:num)', 'BarangController::update/$1');
    $routes->get('delete/(:num)', 'BarangController::delete/$1');
});

$routes->group('barang-log', ['filter' => 'authGuard'], function($routes){
    $routes->get('(:num)', 'BarangLogController::index/$1');
    $routes->get('create/(:num)', 'BarangLogController::create/$1');
    $routes->post('save', 'BarangLogController::save');
});

$routes->group('karyawan', ['filter' => 'authGuard'], function($routes){
    $routes->get('/', 'KaryawanController::index');
    $routes->get('create', 'KaryawanController::create');
    $routes->post('store', 'KaryawanController::store');
    $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
    $routes->post('update/(:num)', 'KaryawanController::update/$1');
    $routes->get('delete/(:num)', 'KaryawanController::delete/$1');
});

// Data Engine
$routes->group('data-engine', function($routes) {
    $routes->get('/', 'DataEngineController::index');
    $routes->get('create', 'DataEngineController::create');
    $routes->post('store', 'DataEngineController::store');
    $routes->get('edit/(:num)', 'DataEngineController::edit/$1');
    $routes->post('update/(:num)', 'DataEngineController::update/$1');
    $routes->get('delete/(:num)', 'DataEngineController::delete/$1');
});

    $routes->post('data-engine/importExcel', 'DataEngineController::importExcel');
    $routes->post('data-engine/previewExcel', 'DataEngineController::previewExcel');

$routes->group('maintenance-engine', function ($routes) {
    $routes->get('/', 'EngineMaintenanceController::index');
    $routes->get('create', 'EngineMaintenanceController::create');
    $routes->post('store', 'EngineMaintenanceController::store');
    $routes->get('edit/(:num)', 'EngineMaintenanceController::edit/$1');
    $routes->post('update/(:num)', 'EngineMaintenanceController::update/$1');
    $routes->get('delete/(:num)', 'EngineMaintenanceController::delete/$1');
});

$routes->group('alert', function($routes) {
    $routes->get('/', 'AlertController::index');
    $routes->get('create', 'AlertController::create');
    $routes->post('store', 'AlertController::store');
    $routes->get('edit/(:num)', 'AlertController::edit/$1');
    $routes->post('update/(:num)', 'AlertController::update/$1');
    $routes->get('delete/(:num)', 'AlertController::delete/$1');
});

$routes->group('produksi', function($routes) {
    $routes->get('/', 'ProduksiController::index');
    $routes->get('create', 'ProduksiController::create');
    $routes->post('store', 'ProduksiController::store');
    $routes->get('edit/(:num)', 'ProduksiController::edit/$1');
    $routes->post('update/(:num)', 'ProduksiController::update/$1');
    $routes->get('delete/(:num)', 'ProduksiController::delete/$1');
});

$routes->group('tahun-aktif', function($routes) {
    $routes->get('/', 'TahunAktifController::index');
    $routes->post('store', 'TahunAktifController::store');
    $routes->post('set', 'TahunAktifController::setAktif');
});

$routes->post('produksi/import', 'ProduksiController::importExcel');
$routes->post('produksi/import-save', 'ProduksiController::importSave');






