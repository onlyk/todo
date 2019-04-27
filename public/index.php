<?php

namespace todo;
require __DIR__ . '/../vendor/autoload.php';

$opt = array(
	\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
);

$pdo = new \PDO('pgsql:host=localhost;port=5432;dbname=todo;', "postgres", "misamisa", $opt);

// $result = $pdo->query("SELECT * FROM tasks")->fetchAll(\PDO::FETCH_ASSOC);



switch ($_SERVER['PATH_INFO']) {
	case '':
		$task = new Task($pdo);
		$task->returnAllTasks($pdo);
		break;
	case '/task/create':
		$name = $_GET['name'];
		$body = $_GET['body'];

		$task = new Task($pdo);
		$task->createTask($name, $body);
		break;
	case '/task/markdone':
		$id = $_GET['id'];
		$task = new Task($pdo);
		$task->markDone($id);
		break;
	case '/task/delete':
		$id = $_GET['id'];
		$task = new Task($pdo);
		$task->deleteTask($id);
		break;
	default:
		echo 404;
		break;
}


// $stmt = $pdo->prepare('Some sql here');
// $stmt->execute(['someParam1' => 13, 'someParam2' => 42]);
// $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);