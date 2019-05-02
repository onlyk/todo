<?php 

namespace App;


use App\TaskRepository;
use App\Task;
use App\TaskData;

class TaskService
{
	private $repository;

	public function __construct($taskRepository)
	{	
		$this->repository = $taskRepository;
	}

	public static function init($taskRepository)
	{	
		return new self($taskRepository);
	}

	public function taskCreate(String $name, String $body)
	{
		$task = Task::createNew($name, $body);
		
		$this->repository->store($task->getTaskData());

	}
}