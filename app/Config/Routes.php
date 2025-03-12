<?php

use App\Controllers\Courses;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Mahasiswa;
use App\Controllers\Students;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Students::index');

// $routes->get('/mahasiswa', [Mahasiswa::class, 'index']);
// $routes->get('/mahasiswa/detail/(:num)', [Mahasiswa::class, 'detail/$1']);
// $routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
// $routes->post('/mahasiswa/create', [Mahasiswa::class, 'store']);
// $routes->get('/mahasiswa/update/(:num)', [Mahasiswa::class, 'edit/$1']);
// $routes->put('/mahasiswa/update/(:num)', [Mahasiswa::class, 'update']);
// $routes->delete('/mahasiswa/delete/(:num)', [Mahasiswa::class, 'delete/$1']);

// $routes->get('student', 'Students::index');
// $routes->get('student/profile/(:num)', [Students::class, 'profile/$1']);
// $routes->get('student/create', [Students::class, 'create']);
// $routes->post('student/create', [Students::class, 'store']);
// $routes->get('student/update/(:num)', [Students::class, 'update/$1']);
// $routes->put('student/update/(:num)', [Students::class, 'edit/$1']);
// $routes->delete('student/delete/(:num)', [Students::class, 'delete/$1']);

// $routes->get('academic', 'Academic::index');
// $routes->get('academic/statistic', 'Academic::statistic');

// $routes->get('course', 'Courses::index');
// $routes->get('course/detail/(:num)', [Courses::class, 'detail/$1']);
// $routes->get('course/create', [Courses::class, 'create']);
// $routes->post('course/create', [Courses::class, 'store']);
// $routes->get('course/update/(:num)', [Courses::class, 'update/$1']);
// $routes->put('course/update/(:num)', [Courses::class, 'edit/$1']);
// $routes->delete('course/delete/(:num)', [Courses::class, 'delete/$1']);

$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::attemptRegister');

    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');
});

// Routes yang hanya bisa diakses admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('manage-users', 'Auth::manageUsers');
    $routes->get('manage-roles', 'Auth::manageRoles');
});

// Routes yang hanya bisa diakses lecturer
$routes->group('lecturer', ['filter' => 'role:lecturer'], function ($routes) {
    $routes->get('dashboard', 'Lecturer::dashboard');
    $routes->get('manage-courses', 'Lecturer::courses');
    $routes->get('manage-courses', 'Courses:index');
});

// Routes yang hanya bisa diakses student
$routes->group('student', ['filter' => 'role:student'], function ($routes) {
    $routes->get('dashboard', 'Students::dashboard');
    $routes->get('enrollment', 'Students::enrollment');
    $routes->get('grades', 'Students::grades');
    $routes->get('profile', 'Students::profile');
    $routes->get('statistic', 'Academic::statistic');
});

// Routes yang bisa diakses oleh lecturer dan admin
$routes->group('', ['filter' => 'role:admin,lecturer'], function ($routes) {
    $routes->get('reports', 'Report::index');
    $routes->get('generate-report', 'Report::generate');
});

$routes->group('admin/users', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->put('update/(:num)', 'Users::update/$1');
    $routes->delete('delete/(:num)', 'Users::delete/$1');
});