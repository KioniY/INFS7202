<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('/', 'menuController::index');
$routes->post('/register', 'menuController::registerUser');
$routes->post('/login', 'menuController::loginUser');
$routes->get('menu/logout', 'menuController::logout');
$routes->get('menu/profile', 'menuController::profile');


$routes->get('/register', 'menuController::register');
$routes->get('/home', 'menuController::home');
$routes->get('/category', 'menuController::category');
$routes->get('/orders', 'menuController::orders');
$routes->get('/products', 'menuController::products');
$routes->get('/customerview', 'menuController::customerview');
$routes->get('/userinformation', 'menuController::userinformation');
$routes->get('/admin', 'menuController::admin');


$routes->get('products/(:num)', 'menuController::products/$1');


$routes->resource('category1');
$routes->resource('product1');
$routes->resource('user1');
$routes->delete('user1/(:num)', 'User1::delete/$1');
$routes->post('user1/delete/(:num)', 'User1::delete/$1');  
$routes->get('user1/add', 'User1::add');
$routes->post('user1/create', 'User1::create');




$routes->post('menu/profile/edit', 'menuController::editProfile');
$routes->get('menu/profile/edit', 'menuController::editProfile');
$routes->get('menu/profile/see-qr-codes', 'menuController::seeQrCodes');

$routes->post('/checkout', 'Checkout::index');
$routes->post('checkout/finish/(:num)', 'Checkout::finish/$1');
$routes->post('checkout/cancel/(:num)', 'Checkout::cancel/$1');




