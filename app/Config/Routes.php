<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

// Auth
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');

$routes->get('/logout', 'Auth::logout');

// General dashboard (redirects based on role in Auth::dashboard)
$routes->get('/dashboard', 'Auth::dashboard');

// ✅ Role-specific dashboards
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/teacher/dashboard', 'TeacherController::dashboard');
$routes->get('/student/dashboard', 'StudentController::dashboard');

// Courses
$routes->post('/course/enroll', 'Course::enroll');






