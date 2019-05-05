<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DependencyContainer;
use App\Connect\Config;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
// use App\Task;
use App\Connect\Connect;
use Zend\Diactoros\Response;

// Вот тут понимаю, имплементация пср-7 интерфейса

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

// тут не до конца понимаю, контейнер для роутера, но видимо это для работы либы
$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

$map->post('task.create', '/tasks', function ($request) use ($controller) {
    $result = $controller->taskCreate($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
    });

$map->post('task.body.update', '/tasks/{uuid}/body/update', function ($request) use ($controller){
    $result = $controller->taskBodyUpdate($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
});

$map->post('task.status.update', '/tasks/{uuid}/status/update', function ($request) use ($controller){
    $result = $controller->taskStatusUpdate($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
});

$map->delete('task.delete', '/tasks/{uuid}', function ($request) use ($controller){
    $result = $controller->taskDelete($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
});

$map->get('task', '/tasks/{uuid}', function ($request) use ($controller){
    $result = $controller->find($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
});

$map->get('task.all', '/tasks', function ($request) use ($controller){
    $result = $controller->findAll($request);
    $response = new Response();
    $response->getBody()->write($result);
    return $response;
});




// объект для сравнения путей и запроса
$matcher = $routerContainer->getMatcher();

// .. and try to match the request to a route.
$route = $matcher->match($request);
if (! $route) {
    echo "No route found for the request.";
    exit;
}

// Насколько я понял, в $request записываем все что получили в $route, но уже согласно psr-7
foreach ($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

// дальше мне не ясно.

// dispatch the request to the route handler.
// (consider using https://github.com/auraphp/Aura.Dispatcher
// in place of the one callable below.)
$callable = $route->handler;
$response = $callable($request, $response);

// emit the response
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();


