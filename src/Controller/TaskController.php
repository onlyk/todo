<?php

namespace App\Controller;

use App\Service\TaskService;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response;
use Ramsey\Uuid\Uuid;


class TaskController
{
	private $service;

	public function __construct(TaskService $taskService)
	{
		$this->service = $taskService;
	}

	public function taskCreate(ServerRequest $request) : Response
	{
		$taskName = $request->getQueryParams()['name'];
		$taskBody = $request->getQueryParams()['body'];
		$uuid = $this->service->taskCreate($taskName, $taskBody);
		$result = $uuid->toString();
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}

	public function taskBodyUpdate(ServerRequest $request) : Response
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$body = $request->getQueryParams()['body'];
		$result = $this->service->taskBodyUpdate($uuid, $body);
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}

	public function taskStatusUpdate(ServerRequest $request) : Response
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$status = $request->getQueryParams()['status'];
		$result = $this->service->taskStatusUpdate($uuid, $status);
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}

	public function taskDelete(ServerRequest $request) : Response
	{
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$result = $this->service->taskDelete($uuid);
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}

	public function find(ServerRequest $request) : Response
	{	
		$uuid = Uuid::fromString($request->getAttribute('uuid'));
		$result = $this->service->find($uuid);
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}

	public function findAll(ServerRequest $request) : Response
	{
		$result = json_encode($this->service->findAll());
		$json = json_encode($result);
		$response = new Response();
		$response->getBody()->write($json);

		return $response;
	}
}