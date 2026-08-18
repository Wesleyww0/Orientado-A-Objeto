$routes->group('api', function($routes) {
    $routes->post('cadastrar', 'AuthController::cadastrar');
    $routes->post('login', 'AuthController::login');
});