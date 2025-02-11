<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Hello;
use App\Controllers\Mahasiswa;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('hello', [Hello::class, 'index']);
$routes->get('hello/model', [Hello::class, 'hello_model']);
$routes->get('hello/view', [Hello::class, 'hello_view']);
$routes->get('hello/mvc', [Hello::class, 'hello_mvc']);

$routes->get('/mahasiswa', [Mahasiswa::class, 'index']);
$routes->get('/mahasiswa/detail/(:segment)', [Mahasiswa::class, 'detail/$1']);
$routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
$routes->post('/mahasiswa/create', [Mahasiswa::class, 'store']);
$routes->get('/mahasiswa/update/(:segment)', [Mahasiswa::class, 'edit/$1']);
$routes->post('/mahasiswa/update/(:segment)', [Mahasiswa::class, 'update/$1']);
$routes->get('/mahasiswa/delete/(:segment)', [Mahasiswa::class, 'delete/$1']);