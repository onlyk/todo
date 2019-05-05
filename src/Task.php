<?php


namespace App;
use App\TaskData;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class Task
{
    private $taskData;

    public function __construct($uuid, $name, $body, $status)
    {   
        $this->taskData = new TaskData($uuid, $name, $body, $status);
    }
    
    public static function createNew($name, $body)
    {
        $uuid = Uuid::uuid4();
        $status = 'new';
        return new self($uuid, $name, $body, $status);
    }

    public static function createFromDTO($taskData)
    {
        return new self($taskData->uuid, $taskData->name, $taskData->body, $taskData->status);
    }

    public function taskBodyUpdate($body)
    {   
        try {
            if ($this->taskData->body === 'done') {
                throw new Exception('Задача не может быть изменена, т.е ее статус: done');
            }

            if ($this->taskData->body === 'canceled') {
                throw new Exception('Задача не может быть изменена, т.е ее статус: canceled');
            }
           
        }
         {
            echo 'Изменить задачу нельзя';
        } else {
            $this->taskData->body = $body;
        }
    }

    public function taskStatusUpdate($status)
    {

    }

    public function getTaskData()
    {
        return $this->taskData;
    }

}