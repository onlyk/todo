<?php

namespace App;

use App\TaskService;
use App\Connect\Connect;
use App\Connect\Config;
class TaskController
{
	private $service;

	public function __construct()
	{
		$this->service = TaskService::init($connect);
	}

	public static function create() : self
	{	
		$connectionString = Config::getConnectionString();
		$connectionOptions = Config::getOptions();
		$connect = Connect::connect($connectionString, $connectionOptions)->get();
		
		return new self($connect);
	}

	public function taskCreate($request) : string
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