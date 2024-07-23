<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/stock', 'StockController::index');
$routes->get('/stock/view/(:segment)', 'StockController::view/$1');
$routes->get('/stock/create', 'StockController::create');
$routes->post('/stock/create/post', 'StockController::create_post');
$routes->post('/stock/remove/(:segment)', 'StockController::remove/$1');
$routes->get('/stock/edit/(:segment)', 'StockController::edit/$1');
$routes->post('/stock/update/(:segment)', 'StockController::update/$1');