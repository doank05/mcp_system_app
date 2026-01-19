<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// PUBLIC
$routes->get('/', 'Home::index');
$routes->get('/inform', 'PageController::inform');
$routes->get('/about', 'PageController::about');
$routes->get('/alur', 'PageController::alur');
$routes->get('/perawatan', 'PageController::perawatan');
$routes->get('/laporan', 'PageController::laporan');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('inventory/engine/', 'InventoryController::engineIndex');
$routes->get('inventory/non-engine/', 'InventoryController::nonEngineIndex');

    // DETAIL INVENTORY
    $routes->get('inventory/engine/detail/(:num)', 'InventoryController::detailEngine/$1');
    $routes->get('inventory/non-engine/detail/(:num)', 'InventoryController::nonEngineDetail/$1');

// INVENTORY
$routes->group('inventory', ['filter' => 'authGuard'], function($routes){
        // INVENTORY
    

});

// PEKERJAAN
$routes->group('pekerjaan', ['filter' => 'level:1,2,3'], function($routes){
    $routes->get('/', 'PekerjaanController::index');
    $routes->get('create', 'PekerjaanController::create');
    $routes->post('save', 'PekerjaanController::save');
    $routes->get('edit/(:num)', 'PekerjaanController::edit/$1');
    $routes->post('update/(:num)', 'PekerjaanController::update/$1');
    $routes->get('delete/(:num)', 'PekerjaanController::delete/$1');
});

// BARANG DAN BARANG LOG
$routes->group('barang', ['filter' => 'level:1,3'], function($routes){
    $routes->get('/', 'BarangController::index');
    $routes->get('create', 'BarangController::create');
    $routes->post('save', 'BarangController::save');
    $routes->get('edit/(:num)', 'BarangController::edit/$1');
    $routes->post('update/(:num)', 'BarangController::update/$1');
    $routes->get('delete/(:num)', 'BarangController::delete/$1');
});

$routes->group('barang-log', ['filter' => 'level:1,3'], function($routes){
    $routes->get('(:num)', 'BarangLogController::index/$1');
    $routes->get('create/(:num)', 'BarangLogController::create/$1');
    $routes->post('save', 'BarangLogController::save');
});


// DATA ENGINE
$routes->group('data-engine', ['filter' => 'level:1,3'], function($routes){
    $routes->get('/', 'DataEngineController::index');
    $routes->get('create', 'DataEngineController::create');
    $routes->post('store', 'DataEngineController::store');
    $routes->get('edit/(:num)', 'DataEngineController::edit/$1');
    $routes->post('update/(:num)', 'DataEngineController::update/$1');
    $routes->get('delete/(:num)', 'DataEngineController::delete/$1');

    $routes->post('importExcel', 'DataEngineController::importExcel');
    $routes->post('previewExcel', 'DataEngineController::previewExcel');
});


// ALERT
$routes->group('alert', ['filter' => 'level:1'], function($routes){
    $routes->get('/', 'AlertController::index');
    $routes->get('create', 'AlertController::create');
    $routes->post('store', 'AlertController::store');
    $routes->get('edit/(:num)', 'AlertController::edit/$1');
    $routes->post('update', 'AlertController::update');
    $routes->get('delete/(:num)', 'AlertController::delete/$1');
});

// PRODUKSI
$routes->group('produksi', ['filter' => 'level:1,3'], function($routes){
    $routes->get('/', 'ProduksiController::index');
    $routes->get('create', 'ProduksiController::create');
    $routes->post('store', 'ProduksiController::store');
    $routes->get('edit/(:num)', 'ProduksiController::edit/$1');
    $routes->post('update/(:num)', 'ProduksiController::update/$1');
    $routes->get('delete/(:num)', 'ProduksiController::delete/$1');

    $routes->post('import', 'ProduksiController::importExcel');
    $routes->post('import-save', 'ProduksiController::importSave');
});

// TAHUN AKTIF DAN BUDGET ONLY
$routes->group('tahun-aktif', ['filter' => 'level:1'], function($routes){
    $routes->get('/', 'TahunAktifController::index');
    $routes->post('store', 'TahunAktifController::store');
    $routes->post('set', 'TahunAktifController::setAktif');
});

$routes->group('budget', ['filter' => 'level:1'], function($routes){
    $routes->get('/', 'BudgetController::index');
    $routes->get('create', 'BudgetController::create');
    $routes->post('store', 'BudgetController::store');
    $routes->get('edit/(:num)', 'BudgetController::edit/$1');
    $routes->post('update/(:num)', 'BudgetController::update/$1');
    $routes->get('delete/(:num)', 'BudgetController::delete/$1');
});

$routes->group('maintenance-non-engine', function ($routes) {
        $routes->get('/', 'NonEngineMaintenanceController::index');
        $routes->get('create', 'NonEngineMaintenanceController::create');
        $routes->post('store', 'NonEngineMaintenanceController::store');

        // EDIT & DELETE
        $routes->get('edit/(:num)', 'NonEngineMaintenanceController::edit/$1');
        $routes->post('update/(:num)', 'NonEngineMaintenanceController::update/$1');
        $routes->get('delete/(:num)', 'NonEngineMaintenanceController::delete/$1');
});

$routes->group('karyawan', ['filter' => 'authGuard'], function($routes){
    $routes->get('/', 'KaryawanController::index');
    $routes->get('create', 'KaryawanController::create');
    $routes->post('store', 'KaryawanController::store');
    $routes->get('edit/(:num)', 'KaryawanController::edit/$1');
    $routes->post('update/(:num)', 'KaryawanController::update/$1');
    $routes->get('delete/(:num)', 'KaryawanController::delete/$1');
});

$routes->group('maintenance-engine', function ($routes) {
    $routes->get('/', 'EngineMaintenanceController::index');
    $routes->get('create', 'EngineMaintenanceController::create');
    $routes->post('store', 'EngineMaintenanceController::store');
    $routes->get('edit/(:num)', 'EngineMaintenanceController::edit/$1');
    $routes->post('update/(:num)', 'EngineMaintenanceController::update/$1');
    $routes->get('delete/(:num)', 'EngineMaintenanceController::delete/$1');
});

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']);
