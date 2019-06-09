<?php

namespace App\Validator; 

use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;

class NewTaskValidator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

	public function validate(TaskData $taskData) : Array
	{
		if (strlen($taskData->name) < 1) {
            $this->errors[] = 'Invalid name length';
        }

        if (strlen($taskData->name) >= 10485760) {
            $this->errors[] = 'name out of border';
        }

        if (strlen($taskData->body) >= 10485760) {
            $this->errors[] = 'body out of border';
        }

        if ($taskData->status != 'new') {
            $this->errors[] = 'invalid status';
        }

        if (!Uuid::isValid($taskData->uuid)) {
            $this->errors[] = 'invalid uuid';
        }

        return $this->errors;
    }
}
