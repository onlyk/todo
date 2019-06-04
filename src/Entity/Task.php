<?php

namespace App\Entity;

use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
    private $errors;
    private $uuid;
    private $name;
    private $body;
    private $status;

    private function __construct(Uuid $uuid, String $name, String $body, String $status)
    {   
        $this->uuid = $uuid;
        $this->name = $name;
        $this->body = $body;
        $this->status = $status;
    }
    
    public static function createNew(String $name, String $body) : self
    {
        $uuid = Uuid::uuid4();
        $status = 'new';

        return new self($uuid, $name, $body, $status);
    }

    public static function createFromDTO(TaskData $taskData) : self
    {
        return new self($taskData->uuid, $taskData->name, $taskData->body, $taskData->status);
    }

    public function taskBodyUpdate(String $body) : TaskData
    {   
        $errors = [];

        if (strlen($body) < 3) {
            $errors[] = '101';
        }

        if ($this->status === 'done') {
            $errors[] = '102';
        }

        if ($this->status === 'canceled') {
            $errors[] = '103';
        }
        
        if (!$errors) {
            $this->body = $body;
        }
        

        return new TaskData(
            $errors,
            $this->uuid,
            $this->name,
            $this->body,
            $this->status);

    }

    public function taskStatusUpdate(String $status)
    {   
        $possibleStatuses = ['wip', 'canceled', 'done'];
        if (!in_array($status, $possibleStatuses)) {
            throw new \Exception('Изменить статус нельзя, т.к возможные статусы: done, wip, canceled');
        }
        if ($status === 'canceled' && $this->status === 'done') {
            throw new \Exception('Задачу нельзя изменить, она уже выполнена');
        }

        if ($status === 'done' && $this->status === 'canceled') {
            throw new \Exception('Задачу нельзя выполнить, она отменена');
        }

        $this->status = $status;
    }

    public function getTaskData() : TaskData
    {
        return new TaskData([],
            $this->uuid,
            $this->name,
            $this->body,
            $this->status);
    }

}