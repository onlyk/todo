<?php

namespace App\Validator; 

class NewTaskValidator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

	public function validate(string $name, string $body) : Array
	{
		if (strlen($name) < 1) {
            $this->errors[] = 'Invalid name length';
        }

        if (strlen($name) >= 10485760) {
            $this->errors[] = 'name out of border';
        }

        if (strlen($body) >= 10485760) {
            $this->errors[] = 'body out of border';
        }

        return $this->errors;
    }
}
