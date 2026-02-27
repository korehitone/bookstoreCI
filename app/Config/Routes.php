<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Development
// Public Routes
$routes->get('books', 'BookController::index');
$routes->get('books/view/(:num)', 'BookController::details/$1');

// Admin Routes (Grouped for tidiness)
$routes->group('admin', function($routes) {
    $routes->get('books', 'BookController::admin_index');
    $routes->get('books/create', 'BookController::create');
    $routes->post('books/store', 'BookController::store');
    $routes->get('books/edit/(:num)', 'BookController::edit/$1');
    $routes->post('books/update/(:num)', 'BookController::update/$1');
    $routes->get('books/delete/(:num)', 'BookController::delete/$1');
});