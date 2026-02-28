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