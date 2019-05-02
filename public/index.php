<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DependencyContainer;
use App\Connect\Config;
$config = Config::init();
$di = new DependencyContainer($config);

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
// use App\Task;
use App\Connect\Connect;

use Zend\Diactoros\Response;

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

$controller = $di->getTaskController();

var_dump($controller);
$map->post('task.create', '/tasks', function ($request) use ($controller){
	
	$controller->taskCreate($request);
	$response = new Response();
	$response->getBody()->write('work');
	return $response;
});

$map->post('task.body.update', '/tasks/{id}/body/update', function ($request) use ($controller){
	$response = new Response();
	$response->getBody()->write('work');
	return $response;
});

$map->post('task.status.update', '/tasks/{id}/status/update', function ($request) use ($controller){
	$response = new Response();
	$response->getBody()->write('work');
	return $response;
});

$map->delete('task.delete', '/tasks/{id}', function ($request) use ($controller){
	$response = new Response();
	$response->getBody()->write('work');
	return $response;
});

$map->get('task', '/tasks/{id}', function ($request) use ($controller){
	$response = new Response();
	$response->getBody()->write('work');
	return $response;
});

$map->get('task.all', '/tasks', function ($request) use ($controller){
	// $response = new Response();
	// $connectString = App\Connect\Config::get();
	// $opt = App\Connect\Config::getOptions();
	// $pdo = App\Connect\Connect::connect($connectString, $opt)->get();
	// $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = 8");
	// $stmt->execute();
	// $result = $stmt->fetch(\PDO::FETCH_ASSOC)['name'];
	// $response->getBody()->write($result);
	// return $response;
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


