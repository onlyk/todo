<?php

namespace App;

class TaskRepository
{
	private $pdo;
	public function __construct()
	{
		$conf = new Config();
		$opt = $conf->getDBOption();
		$this->pdo = new \PDO($conf->getConnectionString());
	}

	public function find()
	{
		return null;
	}

	public function findAll()
	{
		return [];
	}

	public function store()
	{

	}

	public function create($task)
	{
		$stmt = $this->pdo->prepare("INSERT INTO tasks (name, body, status) VALUES (:name, :body, 'new')");

		$stmt->execute([':name' => $task->getName, ':body' => $task->getBody]);
	}
} 
