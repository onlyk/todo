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

	public function taskCreate(ServerRequest $request) : String
	{
		$taskName = $request->getQueryParams()['name'];
		$taskBody = $request->getQueryParams()['body'];
		$uuid = $this->service->taskCreate($taskName, $taskBody);

		return $uuid->toString();
	}

	public function taskBodyUpdate(ServerRequest $request) : String
	{
		$uuid = $request->getAttribute('uuid');
		$body = $request->getQueryParams()['body'];
		$result = $this->service->taskBodyUpdate($uuid, $body);

		return $result;
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
		$result = $this->servide->taskDelete($uuid);

		return $result;
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