<?php

namespace App;

use Zend\Diactoros\ServerRequest;
use Ramsey\Uuid\Uuid;

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
		$result = $uuid->toString();

		return json_encode($result);
	}

	public function taskBodyUpdate(ServerRequest $request) : String
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$body = $request->getQueryParams()['body'];
		$result = $this->service->taskBodyUpdate($uuid, $body);

		return json_encode($result);
	}

	public function taskStatusUpdate(ServerRequest $request) : String
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$status = $request->getQueryParams()['status'];
		$result = $this->service->taskStatusUpdate($uuid, $status);

		return json_encode($result);
	}

	public function taskDelete(ServerRequest $request) : String
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$result = $this->servide->taskDelete($uuid);

		return json_encode($result);
	}

	public function find(ServerRequest $request) : String
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$taskData = $this->service->find($uuid);

		return json_encode($taskData);
	}

	public function findAll(ServerRequest $request) : String
	{
		$taskAll = json_encode($this->service->findAll());

		return $taskAll;
	}
}