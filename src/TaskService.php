<?php 

namespace App;


use App\TaskRepository;
use App\Task;
use App\TaskData;
use \PDO;
class TaskService
{
	private $repository;

	public function __construct($connect)
	{	
		$this->repository = TaskRepository::create($connect);
	}

	public static function init($connect)
	{	
		var_dump($connect);
		return new self($connect);
	}

	public function taskCreate(String $name, String $body) : String
	{
		$task = Task::createNew($name, $body);
		
		$this->repository->store($task->getTaskData());

	}
}