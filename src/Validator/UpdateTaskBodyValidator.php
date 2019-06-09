<?php

namespace App\Validator; 

use Ramsey\Uuid\Uuid;

class UpdateTaskBodyValidator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

	public function validate(string $uuid, string $body) : Array
	{
		$isValid = Uuid::isValid($uuid);

        if (!$isValid){
            $this->errors[] = 'invalid uuid';
        }

        if (strlen($body) >= 10485760) {
            $this->errors[] = 'body out of border';
        }

        return $this->errors;
    }
}
