<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('face-match', 'FaceMatchController::match');

$routes->group('backend', ['namespace' => 'App\Controllers\Backend'], function ($routes) {
    $routes->get('backendpegawai/getPegawaiData', 'BackendPegawai::getPegawaiData');
});

$routes->group('frontend', function ($routes) {
    $routes->get('master/pegawai', 'Frontend\Master::pegawai');
});
