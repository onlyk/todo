<?php 

namespace App;

use App\Task;
use App\TaskData;
use Ramsey\Uuid\Uuid;

class TaskService
{
	private $repository;

	public function __construct($taskRepository)
	{	
		$this->repository = $taskRepository;
	}

	public static function init($taskRepository) : self
	{	
		return new self($taskRepository);
	}

	public function taskCreate($name, $body) : Uuid
	{
		$task = Task::createNew($name, $body);
		$this->repository->store($task->getTaskData());

		return $task->getTaskData()->uuid;
	}

	public function taskBodyUpdate($uuid, $body)
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$task->taskBodyUpdate($body);
		$this->repository->update($task->getTaskData());
	}

	public function taskStatusUpdate($uuid, $status)
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$task->taskStatusUpdate($status);
		$this->repository->update($task->getTaskData());
	}

	public function taskDelete($uuid)
	{
		$this->repository->delete($uuid);
	}

	public function find($uuid) : TaskData
	{
		return $this->repository->find($uuid);
	}

	public function findAll() : Array
	{
		return $this->repository->findAll();
	}
}