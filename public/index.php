<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DependencyContainer;
use App\Connect\Config;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Zend\Diactoros\Response;

$config = Config::init();
$di = new DependencyContainer($config);
$controller = $di->getTaskController();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

$map->post('task.create', '/tasks', function ($request) use ($controller)
{
    $result = $controller->taskCreate($request);
    $response = new Response();
    $response->getBody()->write($result);

    return $response;
});

$map->post('task.body.update', '/tasks/{uuid}/body/update', function ($request) use ($controller)
{
    $result = $controller->taskBodyUpdate($request);
    $response = new Response();
    $response->getBody()->write($result);

    return $response;
});

$map->post('task.status.update', '/tasks/{uuid}/status/update', function ($request) use ($controller)
{
    $result = $controller->taskStatusUpdate($request);
    $response = new Response();
    $response->getBody()->write($result);

    return $response;
});

$map->delete('task.delete', '/tasks/{uuid}', function ($request) use ($controller)
{
    $result = $controller->taskDelete($request);
    $response = new Response();
    $response->getBody()->write($result);

    return $response;
});

$map->get('task', '/tasks/{uuid}', function ($request) use ($controller)
{
    $result = $controller->find($request);
    $response = new Response();
    $response->getBody()->write($result);

    return $response;
});

$map->get('task.all', '/tasks', function ($request) use ($controller)
{
    $result = $controller->findAll($request);
    $response = new Response();
    $response->getBody()->write($result);
    
    return $response;
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

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();


