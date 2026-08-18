<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    $routes->post('cadastrar', 'AuthController::cadastrar');
    $routes->post('login', 'AuthController::login');
});