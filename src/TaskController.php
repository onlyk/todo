<?php

namespace App;

use Zend\Diactoros\ServerRequest;

class TaskController
{
	private $service;

	public function __construct(TaskService $taskService)
	{
		$this->service = $taskService;
	}

	public static function init(TaskService $taskService) : self
	{	
		return new self($taskService);
	}

	public function taskCreate(ServerRequest $request) : String
	{
		$taskName = $request->getQueryParams()['name'];
		$taskBody = $request->getQueryParams()['body'];
		$this->service->taskCreate($taskName, $taskBody);

		return 'work';
	}

	public function taskBodyUpdate(ServerRequest $request) : String
	{
		$uuid = $request->getAttribute('uuid');
		$body = $request->getQueryParams()['body'];
		$this->service->taskBodyUpdate($uuid, $body);

		return 'work';
	}

	public function taskStatusUpdate(ServerRequest $request) : String
	{
		$uuid = $request->getAttribute('uuid');
		$status = $request->getQueryParams()['status'];
		$result = $this->service->taskStatusUpdate($uuid, $status);

		return $result;
		
	}

	public function taskDelete(ServerRequest $request) : String
	{
		$uuid = $request->getAttribute('uuid');
		$this->servide->taskDelete($uuid);
	}

	public function find(ServerRequest $request) : String
	{
		$uuid = $request->getAttribute('uuid');
		$task = json_encode($this->service->find($uuid));

		return $task;
	}

	public function findAll(ServerRequest $request) : String
	{
		$taskAll = json_encode($this->service->findAll());

		return $taskAll;
	}
}