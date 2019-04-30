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
		$some = (string) $repo->create($task);
		return $some;
	}


	public function viewTask($request) : string
	{
		$id = $request->getAttribute('id');
		$task = Task::fromDB($id);
		return (string) $task;
	}

}