<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProductosController::index');
$routes->get('/(:num)', 'ProductosController::showOne/$1');
$routes->post('/create', 'ProductosController::create');
$routes->delete('/delete/(:num)','ProductosController::delete/$1');
$routes->put('modify/(:num)','ProductosController::modify/$1');