<?php

namespace App\Validator; 

class NewTaskValidator
{
	public function validate(string $name, string $body) : Array
	{
		$errors = [];
		if (strlen($name) < 3) {
            $errors[] = 'Задача не может быть создана, т.к имя меньше трех символов';
        }

        if (strlen($body) < 3) {
            $errors[] = 'Задача не может быть создана, т.к содержит меньше трех символов';
        }

        return $errors;
    }
}
