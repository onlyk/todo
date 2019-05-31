<?php
namespace App\DependencyContainer;

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
    
    public function getTaskController() : TaskController
    {
        if (!isset($this->initDep[TaskController::class])) {
            $this->initDep[TaskController::class] = new TaskController($this->getTaskService());
        }
        
        return $this->initDep[TaskController::class];
    }
    
    public function getTaskService() : TaskService
    {
        if (!isset($this->initDep[TaskService::class])) {
            $this->initDep[TaskService::class] = new TaskService($this->getTaskRepository());
        }
        
        return $this->initDep[TaskService::class];
    }

    public function getTaskRepository() : TaskRepository
    {
        if (!isset($this->initDep[TaskRepository::class])) {
            $connect = $this->getConnect()->get();
            $this->initDep[TaskRepository::class] = new TaskRepository($connect);
        }
        
        return $this->initDep[TaskRepository::class];
    }
    
    public function getConnect() : Connect
    {
        if (!isset($this->initDep[Connect::class])) {
        	$connectString = $this->config->getConnectString();
        	$options = $this->config->getOptions();
            $this->initDep[Connect::class] = new Connect($connectString, $options);
        }
        
        return $this->initDep[Connect::class];
    }

}