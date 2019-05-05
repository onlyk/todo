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

	public function taskCreate($name, $body)
	{
		$task = Task::createNew($name, $body);
		$this->repository->store($task->getTaskData());
	}

	public function taskBodyUpdate($uuid, $body)
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$task->taskBodyUpdate($body);
		$this->repository->store($task->getTaskData());
	}

	public function taskStatusUpdate($uuid, $status)
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$task->taskStatusUpdate($status);
		$this->repository->store($task->getTaskData());
	}

	public function taskDelete($uuid)
	{
		$this->repository->delete($uuid);
	}

	public function find($uuid)
	{
		return $this->repository->find($uuid);
	}

	public function findAll()
	{
		return $this->repository->findAll();
	}
}