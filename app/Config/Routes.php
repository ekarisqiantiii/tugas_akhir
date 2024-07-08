<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('face-match', 'FaceMatchController::match');

$routes->group('backend', function ($routes) {
    $routes->get('BackendPegawai', 'Backend\BackendPegawai::index');
    $routes->post('BackendPegawai/create', 'Backend\BackendPegawai::create');
    $routes->put('BackendPegawai/update/(:segment)', 'Backend\BackendPegawai::update/$1');
    $routes->delete('BackendPegawai/delete/(:segment)', 'Backend\BackendPegawai::delete/$1');
});

$routes->group('frontend', function ($routes) {
    $routes->get('Master/pegawai', 'Frontend\Master::pegawai');
});
