<?php
namespace App;

use app\Connect\Config;
use App\Connect\Connect;
use App\TaskController;
use App\TaskService;
use App\TaskRepository;

class DependencyContainer
{
    private $config;
    private $initDep = [];
    
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    public function getTaskController()
    {
        if (!isset($this->initDep[TaskController::class])) {
            $this->initDep[TaskController::class] = TaskController::init($this->getTaskService());
        }
        
        return $this->initDep[TaskController::class];
    }
    
    public function getTaskService()
    {
        if (!isset($this->initDep[TaskService::class])) {
            $this->initDep[TaskService::class] = TaskService::init($this->getTaskRepository());
        }
        
        return $this->initDep[TaskService::class];
    }

    public function getTaskRepository()
    {
        if (!isset($this->initDep[TaskRepository::class])) {
            $connect = $this->getConnect()->get();
            $this->initDep[TaskRepository::class] = TaskRepository::init($connect);
        }
        
        return $this->initDep[TaskRepository::class];
    }
    
    public function getConnect()
    {
        if (!isset($this->initDep[Connect::class])) {
        	$connectString = $this->config->getConnectString();
        	$options = $this->config->getOptions();
            $this->initDep[Connect::class] = Connect::connect($connectString, $options);
        }
        
        return $this->initDep[Connect::class];
    }

}