<?php

namespace App\Entity;
use Ramsey\Uuid\Uuid;

class TaskData
{
	public $uuid;
	public $name;
	public $body;
	public $status;

	public function __construct(Uuid $uuid = null, string $name = null, string $body = null, string $status = null)
	{
		$this->uuid = $uuid;
		$this->name = $name;
		$this->body = $body;
		$this->status = $status;
	}
}
