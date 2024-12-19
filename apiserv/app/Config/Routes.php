<?php

use App\Controllers\Home;
use App\Controllers\StockController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', [Home::class, 'test']);
$routes->get('index', [StockController::class,'index']);
$routes->get('testDB', [StockController::class,'testDB']);
$routes->get('cek', [StockController::class,'read']);
$routes->add('data_post', [StockController::class,'create']);
$routes->put('data_update/(:num)', 'StockController::update/$1');
$routes->delete('data_delete/(:num)', 'StockController::delete/$1');
