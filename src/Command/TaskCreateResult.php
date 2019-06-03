<?php

namespace App\Command;

use Ramsey\Uuid\Uuid;

class TaskCreateResult	
{
	private $status;
	private $data;

	public function __construct(string $status, Uuid $data)
	{
		$this->status = $status;
		$this->data = $data;
	}
	public function getStatus()
	{
		return $status;
	}

	public function getData()
	{
		return $data;
	}
}