<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// =======================
// AUTHENTICATION
// =======================
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/logout', 'Auth::logout');

// General dashboard (redirects based on role)
$routes->get('/dashboard', 'Auth::dashboard');


// =======================
// ANNOUNCEMENTS
// =======================
$routes->get('/announcements', 'Announcement::index');

// =======================
// COURSES
// =======================
$routes->post('course/enroll', 'Course::enroll');

// Upload materials (Admin/Teacher)
$routes->get('/admin/course/(:num)/upload', 'Materials::upload/$1');
$routes->post('/admin/course/(:num)/upload', 'Materials::upload/$1');

// Direct upload route (optional)
$routes->get('/materials/upload/(:num)', 'Materials::upload/$1');
$routes->post('/materials/upload/(:num)', 'Materials::upload/$1');

// Delete material
$routes->get('/materials/delete/(:num)', 'Materials::delete/$1');

// Download material
$routes->get('/materials/download/(:num)', 'Materials::download/$1');
