<?php

use App\Controllers\Courses;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// $routes->get('/mahasiswa', [Mahasiswa::class, 'index']);
// $routes->get('/mahasiswa/detail/(:num)', [Mahasiswa::class, 'detail/$1']);
// $routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
// $routes->post('/mahasiswa/create', [Mahasiswa::class, 'store']);
// $routes->get('/mahasiswa/update/(:num)', [Mahasiswa::class, 'edit/$1']);
// $routes->put('/mahasiswa/update/(:num)', [Mahasiswa::class, 'update']);
// $routes->delete('/mahasiswa/delete/(:num)', [Mahasiswa::class, 'delete/$1']);

// $routes->get('academic', 'Academic::index');
// $routes->get('academic/statistic', 'Academic::statistic');

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::attemptRegister');

    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');
});

// Routes yang hanya bisa diakses admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('statistic', 'Admin::statistic');
});

// Routes yang hanya bisa diakses lecturer
$routes->group('lecturer', ['filter' => 'role:lecturer'], function ($routes) {
    $routes->get('dashboard', 'Lecturer::dashboard');
});

// Routes yang hanya bisa diakses student
$routes->group('student', ['filter' => 'role:student'], function ($routes) {
    $routes->get('dashboard', 'Students::dashboard');
    $routes->get('grades', 'Students::grades');
    $routes->get('profile', 'Students::profile');
    $routes->get('profile/view-highschool-diploma', 'Students::showUpload');
    $routes->get('profile/upload', 'Students::getUpload');
    $routes->post('profile/upload', 'Students::upload');
    $routes->get('enrollment', 'Enrollment::index');
    $routes->get('enrollment/create', 'Enrollment::create');
    $routes->post('enrollment/create', 'Enrollment::store');
    $routes->get('statistic', 'Academic::statistic');
});

// Routes yang bisa diakses oleh lecturer dan admin
$routes->group('reports', ['filter' => 'role:admin,lecturer'], function ($routes) {
    $routes->get('enrollment', 'Report::enrollmentForm');
    $routes->get('enrollment-excel', 'Report::enrollmentExcel');
    $routes->get('student', 'Report::studentsbyprogramForm');
    $routes->post('student-pdf', 'Report::studentsbyprogramPdf');
});

$routes->group('admin/users', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->put('update/(:num)', 'Users::update/$1');
    $routes->delete('delete/(:num)', 'Users::delete/$1');
});

$routes->group('admin/students', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Students::index');
    $routes->get('detail/(:num)', 'Students::detail/$1');
    $routes->get('create', 'Students::create');
    $routes->post('store', 'Students::store');
    $routes->get('update/(:num)', 'Students::update/$1');
    $routes->put('update/(:num)', 'Students::edit/$1');
    $routes->delete('delete/(:num)', 'Students::delete/$1');
});

$routes->group('lecturer/courses', ['filter' => 'role:lecturer'], function ($routes) {
    $routes->get('/', 'Courses::index');
    $routes->get('detail/(:num)', [Courses::class, 'detail/$1']);
    $routes->get('create', [Courses::class, 'create']);
    $routes->post('create', [Courses::class, 'store']);
    $routes->get('update/(:num)', [Courses::class, 'update/$1']);
    $routes->put('update/(:num)', [Courses::class, 'edit/$1']);
    $routes->delete('delete/(:num)', [Courses::class, 'delete/$1']);
});
