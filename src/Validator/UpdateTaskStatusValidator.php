<?php

namespace App\Validator; 

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

        if (strlen($status) >= 10485760) {
            $this->errors[] = 'status out of border';
        }

        return $this->errors;
    }
}
