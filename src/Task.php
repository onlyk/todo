<?php


namespace App;
use App\TaskData;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
	private $taskData;

	public function __construct($uuid, $name, $body, $status)
	{	
		$this->taskData = new TaskData($uuid, $name, $body, $status);
	}
	
	public static function createNew($name, $body)
	{
		$uuid = Uuid::uuid4();
		$status = 'new';
		return new self($uuid, $name, $body, $status);
	}

	public function getTaskData()
	{
		return $this->taskData;
	}

}