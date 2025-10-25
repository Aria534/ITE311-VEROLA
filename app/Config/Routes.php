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

// Upload form (GET)
$routes->get('/admin/course/(:num)/upload', 'Materials::upload/$1');

// Handle upload (POST)
$routes->post('/admin/course/(:num)/upload', 'Materials::upload/$1');

// Download and delete
$routes->get('/materials/download/(:num)', 'Materials::download/$1');
$routes->get('/materials/delete/(:num)', 'Materials::delete/$1');


