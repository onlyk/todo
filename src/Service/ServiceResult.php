<?php

namespace App\Service;

use App\Entity\TaskData;

class ServiceResult{

	public $errors;
	public $data;

	public function __construct(?array $errors, ?TaskData $data)
	{
		$this->errors = $errors;
		$this->data = $data;
	}
}