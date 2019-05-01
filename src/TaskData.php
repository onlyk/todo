<?php

namespace App;

class TaskData
{
	public Uuid $id;
	public String $name;
	public String $body;
	public String $status;

	public function __construct(Uuid $id, String $name, String $body, String $status)
	{
		$this->id = $id;
		$this->name = $name;
		$this->body = $body;
		$this->status = $status;
	}
}