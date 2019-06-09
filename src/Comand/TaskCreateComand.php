<?php

namespace App\Comand;
use Ramsey\Uuid\Uuid;

class TaskCreateComand{

	private $status;
	private $data;

	public function __construct(array $status, Uuid $data)
	{
		$this->status = $status;
		$this->data = $data;

		public function getStatus() : array
		{
			return $this->status;
		}

		public function getData() : Uuid
		{
			return $this->data;
		}
	}
}