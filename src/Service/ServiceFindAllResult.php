<?php

namespace App\Service;

class ServiceFindAllResult
{
	public $errors;
	public $data;

	public function __construct(?array $errors, ?array $data)
	{
		$this->errors = $errors;
		$this->data = $data;
	}
}

