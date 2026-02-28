<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('register', 'CustomerController::register');
$routes->post('register/save', 'CustomerController::save');
$routes->get('login', 'CustomerController::index');
$routes->post('login/auth', 'CustomerController::auth');
$routes->get('profile', 'CustomerController::profile');
$routes->post('profile/update', 'CustomerController::updateProfil');
$routes->put('profile/password', 'CustomerController::updatePassword');
$routes->delete('profile/delete', 'CustomerController::delete');

$routes->get('cart', 'CartController::index');
$routes->post('cart/update-quantity', 'CartItemController::update');
$routes->get('cart/get-summary', 'CartController::getSummary');
$routes->delete('cart/delete-item', 'CartItemController::delete');
$routes->delete('cart/delete-selected', 'CartItemController::deleteSelected');
/** @var RouteCollection $routes */

// -----------------------------------------------------------------------
// PUBLIC — Books & Categories
// -----------------------------------------------------------------------
$routes->get('/',                  'BookController::index');
$routes->get('books',              'BookController::index');
$routes->get('books/(:num)',       'BookController::details/$1');

$routes->get('categories/(:num)',  'CategoryController::show/$1');

// -----------------------------------------------------------------------
// AUTH — Login / Register / Forgot Password
// -----------------------------------------------------------------------
$routes->get('login',              'AdminController::login');
$routes->post('login',             'AdminController::attemptLogin');
$routes->get('logout',             'AdminController::logout');

$routes->get('register/admin',     'AdminController::register');
$routes->post('register/admin',    'AdminController::attemptRegister');

$routes->get('forgot-password',    'AdminController::forgotPassword');
$routes->post('forgot-password',   'AdminController::resetPassword');

// -----------------------------------------------------------------------
// ADMIN — Protected
// -----------------------------------------------------------------------
$routes->group('admin', function ($routes) {

    // Books
    $routes->get('books',                    'BookController::admin_index');
    $routes->post('books/store',             'BookController::store');
    $routes->post('books/update/(:num)',     'BookController::update/$1');
    $routes->get('books/delete/(:num)',      'BookController::delete/$1');

    // Categories
    $routes->get('categories',               'CategoryController::admin_index');
    $routes->post('categories/store',        'CategoryController::store');
    $routes->post('categories/update/(:num)', 'CategoryController::update/$1');
    $routes->get('categories/delete/(:num)', 'CategoryController::delete/$1');

    // Profile
    $routes->get('profile',                  'AdminController::show');
    $routes->post('profile/update',          'AdminController::updateProfile');
    $routes->post('profile/delete',          'AdminController::deleteProfile');
});