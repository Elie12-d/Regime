<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::init');
$routes->post('/objectif/(:num)', 'ObjectifController::setObjectif/$1');
$routes->get('/porte-monnaie', 'PorteMonnaie::index');
$routes->get('/traitements', 'AchatRegime::index');
$routes->get('/statistiques', 'StatistiquesController::index');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/liste-regimes', 'RegimeController::afficherRegimesByIdCategorie');
$routes->post('/porte-monnaie/recharger', 'PorteMonnaie::recharger');