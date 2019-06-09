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

		$result = $this->service->taskCreate($taskName, $taskBody);
		if (!$result->errors) {
			$JsonData = json_encode($result->data);
			$response = new Response();
			$response->getBody()->write($JsonData);
			$response = $response->withStatus('201');
		} else {
			$JsonData = json_encode($result->errors);
			$response = new Response();
			$response->getBody()->write($JsonData);
			$response = $response->withStatus('400');
		}
		
		return $response;
	}

	public function find(ServerRequest $request) : Response
	{	
		$uuid =$request->getAttribute('uuid');

		$result = $this->service->find($uuid);
		if (!$result->errors) {
			$JsonData = json_encode($result->data);
			$response = new Response();
			$response->getBody()->write($JsonData);
			$response = $response->withStatus('200');
		} else {
			$JsonData = json_encode($result->errors);
			$response = new Response();
			$response->getBody()->write($JsonData);
			if (in_array('invalid uuid', $result->errors)) {
				$response = $response->withStatus('400');
			} elseif (in_array('not found', $result->errors)) {
				$response = $response->withStatus('404');
			}
		}

		return $response;
	}	

	public function findAll(ServerRequest $request) : Response
	{
		$result = $this->service->findAll();
		
		if (!$result->errors) {
			$jsonData = json_encode($result->data);
			$response = new Response();
			$response->getBody()->write($jsonData);
			$response = $response->withStatus('200');
		} else {
			$jsonData = json_encode($result->errors);
			$response = new Response();
			$response->getBody()->write($jsonData);
			$response = $response->withStatus('404');
		}

		return $response;
	}

	public function taskBodyUpdate(ServerRequest $request) : Response
	{
		$uuid = $request->getAttribute('uuid');
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


}