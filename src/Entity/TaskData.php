<?php

namespace App\Entity;
use Ramsey\Uuid\Uuid;

class TaskData
{
	public $errors;
	public $uuid;
	public $name;
	public $body;
	public $status;

	public function __construct(array $errors, Uuid $uuid, String $name, String $body, String $status)
	{
		$this->errors = $errors;
		$this->uuid = $uuid;
		$this->name = $name;
		$this->body = $body;
		$this->status = $status;
	}
}
