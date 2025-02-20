<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Hello;
use App\Controllers\Mahasiswa;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/mahasiswa', [Mahasiswa::class, 'index']);
$routes->get('/mahasiswa/detail/(:num)', [Mahasiswa::class, 'detail/$1']);
$routes->get('/mahasiswa/detail/(:num)', [Mahasiswa::class, 'detail/$1']);
$routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
$routes->post('/mahasiswa/create', [Mahasiswa::class, 'store']);
$routes->get('/mahasiswa/update/(:num)', [Mahasiswa::class, 'edit/$1']);
$routes->put('/mahasiswa/update/(:num)', [Mahasiswa::class, 'update']);
$routes->delete('/mahasiswa/delete/(:num)', [Mahasiswa::class, 'delete/$1']);

$routes->get('student', 'Students::index');
$routes->get('student/profile/(:num)', 'Students::profile/$1');

$routes->get('academic', 'Academic::index');
$routes->get('academic/statistic', 'Academic::index');