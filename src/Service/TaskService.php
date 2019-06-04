<?php 

namespace App\Service;

use App\Entity\Task;
use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use App\Validator\NewTaskValidator;

class TaskService
{
	private $repository;
	private $errors;

	public function __construct($taskRepository)
	{	
		$this->repository = $taskRepository;
	}

	public function taskCreate(String $name, String $body) : Uuid
	{
		$task = Task::createNew($name, $body);
		$this->repository->store($task->getTaskData());
		return $task->getTaskData()->uuid;
	}

	public function taskBodyUpdate(Uuid $uuid, String $body) : String
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$taskData = $task->taskBodyUpdate($body);
		if (!$taskData->errors) {
			$this->repository->update($task->getTaskData());
			return 'Задача обновлена';
		} else {
			return 'ощьибка';
		}
		

		
	}

	public function taskStatusUpdate(Uuid $uuid, String $status) : String
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$result = $task->taskStatusUpdate($status);
		$this->repository->update($task->getTaskData());

		return 'Статус задачи обновлен';
	}

	public function taskDelete(Uuid $uuid) : String
	{
		$this->repository->delete($uuid);

		return 'Задача удалена';
	}

	public function find(Uuid $uuid) : TaskData
	{
		return $this->repository->find($uuid);
	}

	public function findAll() : Array
	{
		return $this->repository->findAll();
	}
}