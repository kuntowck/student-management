<?php

use App\Controllers\Courses;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Mahasiswa;
use App\Controllers\Students;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/mahasiswa', [Mahasiswa::class, 'index']);
$routes->get('/mahasiswa/detail/(:num)', [Mahasiswa::class, 'detail/$1']);
$routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
$routes->post('/mahasiswa/create', [Mahasiswa::class, 'store']);
$routes->get('/mahasiswa/update/(:num)', [Mahasiswa::class, 'edit/$1']);
$routes->put('/mahasiswa/update/(:num)', [Mahasiswa::class, 'update']);
$routes->delete('/mahasiswa/delete/(:num)', [Mahasiswa::class, 'delete/$1']);

$routes->get('student', 'Students::index');
$routes->get('student/profile/(:num)', [Students::class, 'profile/$1']);
$routes->get('student/create', [Students::class, 'create']);
$routes->post('student/create', [Students::class, 'store']);
$routes->get('student/update/(:num)', [Students::class, 'update/$1']);
$routes->put('student/update/(:num)', [Students::class, 'edit/$1']);
$routes->delete('student/delete/(:num)', [Students::class, 'delete/$1']);

$routes->get('academic', 'Academic::index');
$routes->get('academic/statistic', 'Academic::statistic');

$routes->get('course', 'Courses::index');
$routes->get('course/detail/(:num)', [Courses::class, 'detail/$1']);
$routes->get('course/create', [Courses::class, 'create']);
$routes->post('course/create', [Courses::class, 'store']);
$routes->get('course/update/(:num)', [Courses::class, 'update/$1']);
$routes->put('course/update/(:num)', [Courses::class, 'edit/$1']);
$routes->delete('course/delete/(:num)', [Courses::class, 'delete/$1']);
