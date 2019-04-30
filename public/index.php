<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Task;
use App\TaskService;
use App\Config;
// Вот тут понимаю, имплементация пср-7 интерфейса

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

// вот тут понимаю, добавляю пути на карту 
// $map->get('tasks', '/tasks', function ($request){
// 	$task = new Task();
// 	$response = new Zend\Diactoros\Response();
// 	$response->getBody()->write($task->returnAllTasks());
// 	return $response;
// });

$map->post('task.create', '/tasks', function ($request) {
	
	$app = new TaskService();
	$response = new Zend\Diactoros\Response();
	$response->getBody()->write($app->createTask($request));
	return $response;
});

// $map->post('task.done', '/tasks/{id}/markdone', function ($request) {
// 	$id = $request->getAttribute('id');
// 	$task = new Task();
// 	$response = new Zend\Diactoros\Response();
// 	$response->getBody()->write($task->markDone($id));
// 	return $response;
// });

// $map->delete('task.delete', '/tasks/{id}', function ($request) {
// 	$id = $request->getAttribute('id');
// 	$task = new Task($pdo);
// 	$response = new Zend\Diactoros\Response();
// 	$response->getBody()->write($task->deleteTask($id));
// 	return $response;
// });

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


