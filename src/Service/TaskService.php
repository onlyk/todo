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

	public function taskCreate(string $name, string $body) : Uuid
	{	
		// 1. Принять данные
		// 2. Засунуть в DTO 
		// 3. Проваладировать DTO
		// 5. Закинуть DTO в БД
		// 6. 
		$uuid = Uuid::uuid4();
        $status = 'new';
		$taskData = new TaskData($uuid, $name, $body, $status);
		$newTaskValidator = new NewTaskValidator();
		$validationErrors = $newTaskValidator($name, $body);	
		if(!$validationErrors) {
			$this->repository->store($taskData);
		} else {
			return $validationErrors;
		}
		
		
		return $task->getTaskData()->uuid;
	}

	public function taskBodyUpdate(Uuid $uuid, string $body) : string
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::taskCreate($taskData);
		$taskData = $task->taskBodyUpdate($body);
		if (!$taskData->errors) {
			$this->repository->update($taskData);
			return 'Задача обновлена';
		} else {
			return $taskData->body;
		}
	}

	public function taskStatusUpdate(Uuid $uuid, string $status) : string
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$result = $task->taskStatusUpdate($status);
		$this->repository->update($task->getTaskData());

		return 'Статус задачи обновлен';
	}

	public function taskDelete(Uuid $uuid) : string
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