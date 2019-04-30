<?php 

namespace App;

class TaskService
{
	public function createTask($request)
	{
		$name = $request->getQueryParams()['name'];
		$body = $request->getQueryParams()['body'];
		$task = new Task(0, $name, $body, 'new');
		$repo = new TaskRepository();
		$repo->create($task);
	}
}