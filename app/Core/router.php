<?php

$injector = require __DIR__.'/dependencies.php';

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$routeDefinitionCallback = function(\FastRoute\RouteCollector $r) {
    $routes = include(__DIR__.'/../routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $handlerInfo = explode('@',$routeInfo[1]);

        $className = $handlerInfo[0];
        $method = $handlerInfo[1];
        $vars = $routeInfo[2];

        $controller = $injector->make($className);
        $controller->$method($vars);

        break;
}

echo $response->getContent();