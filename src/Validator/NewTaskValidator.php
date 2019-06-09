<?php

namespace App\Validator; 

class NewTaskValidator
{
	public function validate(string $name, string $body) : Array
	{
		$errors = [];
		if (strlen($name) < 1) {
            $errors[] = 'Invalid name length';
        }

        if (strlen($name) >= 10485760) {
            $errors[] = 'name out of border';
        }

        if (strlen($body) >= 10485760) {
            $errors[] = 'body out of border';
        }

        return $errors;
    }
}
