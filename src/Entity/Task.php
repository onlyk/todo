<?php

namespace App\Entity;

use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
    const POSSIBLE_STATUSES = ['wip', 'canceled', 'done'];
    private $errors;
    private $uuid;
    private $name;
    private $body;
    private $status;

    private function __construct(Uuid $uuid, string $name, string $body, string $status)
    {   
        $this->uuid = $uuid;
        $this->name = $name;
        $this->body = $body;
        $this->status = $status;
        $this->errors = [];
    }
    
    public static function taskCreate(TaskData $taskData) : self
    {
        return new self($taskData->uuid, $taskData->name, $taskData->body, $taskData->status);
    }

    public function taskBodyUpdate(string $body) : array
    {   
        if ($this->status === 'done') {
            $this->errors[] = 'done';
        }
        if ($this->status === 'canceled') {
            $this->errors[] = 'canceled';
        }
        if (!$this->$errors) {
            $this->body = $body;
        }

        return $this->errors;
    }

    public function taskStatusUpdate(string $status) : array
    {   
        if (!in_array($status, static::POSSIBLE_STATUSES)) {
            $this->errors[] = 'Invalid status';
        }
        if ($status === 'canceled' && $this->status === 'done') {
            $this->errors[] = 'done';
        }
        if ($status === 'done' && $this->status === 'canceled') {
            $this->errors[] = 'canceled';
        }
        if (!$this->errors) {
            $this->status = $status;
        }

        return $this->errors;
    }

    public function getTaskData() : TaskData
    {
        return new TaskData(
            $this->uuid,
            $this->name,
            $this->body,
            $this->status
        );
    }

}