<?php

namespace App;

use App\TaskService;
use App\Connect\Connect;
use App\Connect\Config;
class TaskController
{
	private $service;

	public function __construct($taskService)
	{
		$this->service = $taskService;
	}

	public static function create($taskService) : self
	{	
		return new self($taskService);
	}

	public function taskCreate($request) 
	{
		$taskName = $request->getQueryParams()['name'];
		$taskBody = $request->getQueryParams()['body'];

		$this->service->taskCreate($taskName, $taskBody);
		
	}

	public function updateTaskBody(Request $request) : string
	{

	}

	public function updateTaskStatus(Request $request) : string
	{

	}

	public function deleteTask(Request $request) : string
	{

	}

	public function findTask(Request $request) : string
	{

	}

	public function viewAllTasks(Request $request) : string
	{

	}

}