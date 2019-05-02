<?php

namespace App;
use Ramsey\Uuid\Uuid;

class TaskData
{
	public $uuid;
	public $name;
	public $body;
	public $status;

	public function __construct(Uuid $uuid, String $name, String $body, String $status)
	{
		$this->uuid = $uuid;
		$this->name = $name;
		$this->body = $body;
		$this->status = $status;
	}
}