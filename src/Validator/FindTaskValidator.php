<?php

namespace App\Validator;

use Ramsey\Uuid\Uuid;

class FindTaskValidator
{
	private $errors;

	public function __construct()
    {
        $this->errors = [];
    }

	public function validate(string $uuid)
	{
		$isValid = Uuid::isValid($uuid);
		if (!$isValid) {
			$this->errors[] = 'invalid';
		}

		return $this->errors;
	}
	
}