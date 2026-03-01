<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('register', 'CustomerController::register');
$routes->post('register/save', 'CustomerController::save');
$routes->get('login', 'CustomerController::index');
$routes->post('login/auth', 'CustomerController::auth');

$routes->group('', ['filter' => 'customerAuth'],  function ($routes) {

$routes->get('profile', 'CustomerController::profile');
$routes->post('profile/update', 'CustomerController::updateProfil');
$routes->put('profile/password', 'CustomerController::updatePassword');
$routes->delete('profile/delete', 'CustomerController::delete');
$routes->get('logout', 'CustomerController::logout');

$routes->get('cart', 'CartController::index');
$routes->post('cart/add', 'CartItemController::add');
$routes->post('cart/update-quantity', 'CartItemController::update');
$routes->get('cart/get-summary', 'CartController::getSummary');
$routes->delete('cart/delete-item', 'CartItemController::delete');
$routes->delete('cart/delete-selected', 'CartItemController::deleteSelected');
/** @var RouteCollection $routes */
});

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

$routes->get('admin/login', 'AdminController::login');
$routes->post('admin/login', 'AdminController::attemptLogin');
$routes->get('admin/logout', 'AdminController::logout');

$routes->get('admin/register', 'AdminController::register');
$routes->post('admin/register', 'AdminController::attemptRegister');

// -----------------------------------------------------------------------
// ADMIN — Protected
// -----------------------------------------------------------------------
$routes->group('admin', ['filter' => 'adminAuth'],  function ($routes) {

    $routes->get('forgot-password', 'AdminController::forgotPassword');
    $routes->post('forgot-password', 'AdminController::resetPassword');

    // Books
    $routes->get('/',                    'BookController::admin_index');
    $routes->post('books/store',             'BookController::store');
    $routes->post('books/update/(:num)',     'BookController::update/$1');
    $routes->get('books/delete/(:num)',      'BookController::delete/$1');

    // Categories
    $routes->get('categories',               'CategoryController::admin_index');
    $routes->post('categories/store',        'CategoryController::store');
    $routes->post('categories/update/(:num)', 'CategoryController::update/$1');
    $routes->get('categories/delete/(:num)', 'CategoryController::delete/$1');

    // Profile
    $routes->get('profile', 'AdminController::show');
    $routes->post('profile/update',          'AdminController::updateProfile');
    $routes->post('profile/delete',          'AdminController::deleteProfile');

    $routes->get('logs', 'AdminLogController::index');
});
