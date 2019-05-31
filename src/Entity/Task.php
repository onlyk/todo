<?php

namespace App\Entity;

use App\Entity\TaskData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
    private $taskData;

    private function __construct(Uuid $uuid, String $name, String $body, String $status)
    {   
        $this->taskData = new TaskData($uuid, $name, $body, $status);
    }
    
    public static function createNew(String $name, String $body) : self
    {
        if (strlen($name) < 3) {
            throw new \Exception('Задача не может быть создана, т.к имя меньше трех символов');
        }

        if (strlen($body) < 3) {
            throw new \Exception('Задача не может быть создана, т.к содержит меньше трех символов');
        }

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

        if ($this->taskData->status === 'done') {
            throw new \Exception('Задача не может быть изменена, т.к ее статус: done');
        }

        if ($this->taskData->body === 'canceled') {
            throw new \Exception('Задача не может быть изменена, т.к ее статус: canceled');
        }
        
        $this->taskData->body = $body;
    }

    public function taskStatusUpdate(String $status)
    {   
        $possibleStatuses = ['wip', 'canceled', 'done'];
        if (!in_array($status, $possibleStatuses)) {
            throw new \Exception('Изменить статус нельзя, т.к возможные статусы: done, wip, canceled');
        }
        if ($status === 'canceled' && $this->taskData->status === 'done') {
            throw new \Exception('Задачу нельзя изменить, она уже выполнена');
        }

        if ($status === 'done' && $this->taskData->status === 'canceled') {
            throw new \Exception('Задачу нельзя выполнить, она отменена');
        }

        $this->taskData->status = $status;
    }

    public function getTaskData() : TaskData
    {
        return $this->taskData;
    }

}