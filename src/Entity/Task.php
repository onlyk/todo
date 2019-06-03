<?php

namespace App\Entity;

use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
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

    public function taskBodyUpdate(String $body)
    {   
        if (strlen($body) < 3) {
            throw new \Exception('Задача не изменена, т.к содержит меньше трех символов');
        }

        if ($this->status === 'done') {
            throw new \Exception('Задача не может быть изменена, т.к ее статус: done');
        }

        if ($this->body === 'canceled') {
            throw new \Exception('Задача не может быть изменена, т.к ее статус: canceled');
        }
        
        $this->body = $body;
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
        return new TaskData(
            $this->uuid,
            $this->name,
            $this->body,
            $this->status);
    }

}