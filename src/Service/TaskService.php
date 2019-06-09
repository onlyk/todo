<?php 

namespace App\Service;

use App\Entity\Task;
use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use App\Validator\NewTaskValidator;
use App\Comand\TaskCreateComand;
use App\Service\ServiceResult;
use App\Service\ServiceFindAllResult;

class TaskService
{
	private $repository;
	private $errors;

	public function __construct($taskRepository)
	{	
		$this->repository = $taskRepository;
	}

	public function taskCreate(string $name, string $body) : ServiceResult
	{	
		$uuid = Uuid::uuid4();
        $status = 'new';
		$taskData = new TaskData($uuid, $name, $body, $status);
		$newTaskValidator = new NewTaskValidator();
		$validationErrors = $newTaskValidator->validate($taskData);	

		if ($validationErrors) {
			return new ServiceResult($validationErrors, null);
		}

		$this->repository->store($taskData);
		
		return new ServiceResult(null, $taskData);
	}

	public function taskBodyUpdate(Uuid $uuid, string $body) : ServiceResult
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

	public function taskStatusUpdate(Uuid $uuid, string $status) : ServiceResult
	{
		$taskData = $this->repository->find($uuid);
		$task = Task::createFromDTO($taskData);
		$result = $task->taskStatusUpdate($status);
		$this->repository->update($task->getTaskData());

		return 'Статус задачи обновлен';
	}

	public function taskDelete(Uuid $uuid) : ServiceResult
	{
		$this->repository->delete($uuid);

		return 'Задача удалена';
	}

	public function find(Uuid $uuid) : ServiceResult
	{	
		$repositoryResult = $this->repository->find($uuid);
		if ($repositoryResult->errors) {
			return new ServiceResult($repositoryResult->errors, null);
		}

		return new ServiceResult(null, $repositoryResult->data);
	}

	public function findAll() : ServiceFindAllResult
	{
		$repositoryResult = $this->repository->findAll();
		if ($repositoryResult->errors) {
			return new ServiceFindAllResult($repositoryResult->errors, null);
		}

		return new ServiceFindAllResult(null, $repositoryResult->data);
	}
}