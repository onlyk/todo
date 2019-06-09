<?php

namespace App\Repository;

class RepositoryFindAllResult
{
	public $errors;
	public $data;

	public function __construct(?array $errors, ?array $data)
	{
		$this->errors = $errors;
		$this->data = $data;	
	}
}