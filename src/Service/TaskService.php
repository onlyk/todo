<?php 

namespace App\Service;

use App\Entity\Task;
use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use App\Validator\NewTaskValidator;
use App\Validator\UpdateTaskBodyValidator;
use App\Validator\FindTaskValidator;
use App\Validator\DeleteTaskValidator;
use App\Validator\UpdateTaskStatusValidator;
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

	public function find(string $uuid) : ServiceResult
	{	
		$validator = new FindTaskValidator();
		$validationErrors = $validator->validate($uuid);
		if ($validationErrors) {
			return new ServiceResult($validationErrors, null);
		}

		$uuid = Uuid::fromString($uuid);
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

	public function taskBodyUpdate(string $uuid, string $body) : ServiceResult
	{
		$validator = new UpdateTaskBodyValidator();
		$validationErrors = $validator->validate($uuid, $body);
		if ($validationErrors) {
			return new ServiceResult($validationErrors, null);
		}

		$uuid = Uuid::fromString($uuid);
		$repositoryResult = $this->repository->find($uuid);

		if ($repositoryResult->errors) {
			return new ServiceResult($repositoryResult->errors, null);
		}

		$taskData = $repositoryResult->data;
		$task = Task::taskCreate($taskData);
		$entityErrors = $task->taskBodyUpdate($body);
		if ($entityErrors) {
			return new ServiceResult($entityErrors, null);
		}

		return new ServiceResult(null, $task->getTaskData());
	}

	public function taskStatusUpdate(Uuid $uuid, string $status) : ServiceResult
	{
		$validator = new UpdateTaskStatusValidator();
		$validationErrors = $validator->validate($uuid, $status);
		if ($validationErrors) {
			return new ServiceResult($validationErrors, null);
		}

		$uuid = Uuid::fromString($uuid);
		$repositoryResult = $this->repository->find($uuid);

		if ($repositoryResult->errors) {
			return new ServiceResult($repositoryResult->errors, null);
		}

		$taskData = $repositoryResult->data;
		$task = Task::taskCreate($taskData);
		$entityErrors = $task->taskStatusUpdate($status);
		if ($entityErrors) {
			return new ServiceResult($entityErrors, null);
		}

		return new ServiceResult(null, $task->getTaskData());
	}

	public function taskDelete(Uuid $uuid) : ServiceResult
	{

		$validator = new DeleteTaskValidator();
		$validationErrors = $validator->validate($uuid);
		if ($validationErrors) {
			return new ServiceResult($validationErrors, null);
		}

		$uuid = Uuid::fromString($uuid);
		$repositoryResult = $this->repository->delete($uuid);

		if ($repositoryResult->errors) {
			return new ServiceResult($repositoryResult->errors, null);
		}

		return new ServiceResult(null, $repositoryResult->data);
	}
}