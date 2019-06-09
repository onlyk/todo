<?php

namespace App\Repository;

use App\Entity\TaskData;

class RepositoryResult
{
	public $errors;
	public $data;

	public function __construct(?array $errors, ?TaskData $data)
	{
		$this->errors = $errors;
		$this->data = $data;	
	}
}