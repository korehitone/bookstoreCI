<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// -----------------------------------------------------------------------
// HOME
// -----------------------------------------------------------------------
$routes->get('/', 'Home::index');

// -----------------------------------------------------------------------
// PUBLIC ROUTES - Books & Categories
// -----------------------------------------------------------------------
$routes->get('books', 'BookController::index');
$routes->get('books/(:num)', 'BookController::details/$1');

$routes->get('categories', 'CategoryController::index');
$routes->get('categories/(:num)', 'CategoryController::show/$1');

// -----------------------------------------------------------------------
// AUTH ROUTES - Login/Register/Logout
// -----------------------------------------------------------------------
$routes->get('login', 'AdminController::login');
$routes->post('login', 'AdminController::attemptLogin');
$routes->get('logout', 'AdminController::logout');

$routes->get('register/admin', 'AdminController::register');
$routes->post('register/admin', 'AdminController::attemptRegister');

// -----------------------------------------------------------------------
// ADMIN ROUTES - Protected
// -----------------------------------------------------------------------
$routes->group('admin', function($routes) {

    // Books Management
    $routes->get('books', 'BookController::admin_index');
    $routes->get('books/create', 'BookController::create');
    $routes->post('books/store', 'BookController::store');
    $routes->get('books/edit/(:num)', 'BookController::edit/$1');
    $routes->post('books/update', 'BookController::update');
    $routes->get('books/delete/(:num)', 'BookController::delete/$1');

    // Categories Management
    $routes->get('categories', 'CategoryController::admin_index');
    $routes->get('categories/create', 'CategoryController::create');
    $routes->post('categories/store', 'CategoryController::store');
    $routes->get('categories/edit/(:num)', 'CategoryController::edit/$1');
    $routes->post('categories/update', 'CategoryController::update');
    $routes->post('categories/delete', 'CategoryController::delete');

    // Admin Profile Management
    $routes->get('profile', 'AdminController::show');
    $routes->get('profile/edit', 'AdminController::editProfile');
    $routes->post('profile/update', 'AdminController::updateProfile');
    $routes->post('profile/delete', 'AdminController::deleteProfile');

    // Admin Password Reset
    $routes->get('forgot-password', 'AdminController::forgotPassword');
    $routes->post('forgot-password', 'AdminController::resetPassword');
});