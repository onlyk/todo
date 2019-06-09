<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DependencyContainer\DependencyContainer;
use App\Connect\Config;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

set_exception_handler(function (Exception $exception) {
    echo $exception->getMessage();
});

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

$config = Config::init();
$di = new DependencyContainer($config);
$controller = $di->getTaskController();

$map->post('task.create', '/tasks', function (ServerRequest $request) use ($controller) : Response
{
    return $controller->taskCreate($request);
});

$map->put('task.body.update', '/tasks/{uuid}/body/update', function (ServerRequest $request) use ($controller) : Response
{
    return $controller->taskBodyUpdate($request);
});

$map->put('task.status.update', '/tasks/{uuid}/status/update', function (ServerRequest $request) use ($controller) : Response
{
    return $controller->taskStatusUpdate($request);
});

$map->delete('task.delete', '/tasks/{uuid}', function (ServerRequest $request) use ($controller) : Response
{
    return $controller->taskDelete($request);
});

$map->get('task', '/tasks/{uuid}', function (ServerRequest $request) use ($controller) : Response
{
    return $controller->find($request);
});

$map->get('task.all', '/tasks', function (ServerRequest $request) use ($controller) : Response
{   
    return $controller->findAll($request);
});

$matcher = $routerContainer->getMatcher();

$route = $matcher->match($request);
if (! $route) {
    echo "No route found for the request.";
    exit;
}

foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

$callable = $route->handler;
$response = $callable($request, $response);

http_response_code($response->getStatusCode());

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();


