<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::init');
$routes->post('/objectif/(:num)', 'ObjectifController::setObjectif/$1');
