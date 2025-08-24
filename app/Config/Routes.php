<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Homepage
$routes->get('/', 'Home::index');

// About Page
$routes->get('/about', 'Home::about');

// Contact Page
$routes->get('/contact', 'Home::contact');
