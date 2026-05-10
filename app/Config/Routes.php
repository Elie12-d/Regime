<?php

use App\Controllers\PaiementController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/dashboard', 'Home::init');
$routes->post('/objectif/(:num)', 'ObjectifController::setObjectif/$1');
$routes->get('/porte-monnaie', 'PorteMonnaie::index');
$routes->get('/traitements', 'AchatRegime::index');
$routes->post('/achat-regime/payer', 'AchatRegime::payer');
$routes->get('/statistiques', 'StatistiquesController::index');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/liste-regimes', 'RegimeController::afficherRegimesByIdCategorie');
$routes->get('paiement/(:num)/(:num)', 'RegimeController::setCommande/$1/$2');
$routes->post('paiement/sauvegarderSession', 'PaiementController::sauvegarderSession');
$routes->get('paiement/traitement', 'PaiementController::index');
$routes->post('/porte-monnaie/recharger', 'PorteMonnaie::recharger');
$routes->get('/commande/(:num)', 'RegimeController::commanderRegime/$1');
$routes->get('/inscription', 'Home::inscription');
