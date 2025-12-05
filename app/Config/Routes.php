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

$routes->get('/notifications', 'Notifications::get');
$routes->post('/notifications/mark_read/(:num)', 'Notifications::mark_as_read/$1');

//SEARCH
$routes->get('/courses/search', 'Course::search');
$routes->post('/courses/search', 'Course::search');

// =======================
// USER MANAGEMENT (Admin Only)
// =======================
$routes->get('/users', 'User::index');
$routes->get('/users/create', 'User::create');
$routes->post('/users/store', 'User::store');
$routes->get('/users/edit/(:num)', 'User::edit/$1');
$routes->post('/users/update/(:num)', 'User::update/$1');
$routes->get('/users/delete/(:num)', 'User::delete/$1');



