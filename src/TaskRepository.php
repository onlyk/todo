<?php

namespace App;

class TaskRepository
{
	private $pdo;
	public function __construct()
	{
		$conf = new Config();
		$opt = $conf->getDBOption();
		$this->pdo = new \PDO('pgsql:host=localhost;port=5432;dbname=todo;', "postgres", "misamisa", $opt);
	}

	public function find($id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
		$stmt->execute([':id' => $id]);
		return $stmt->fetch();
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
		$stmt->execute([':name' => $task->getName(), ':body' => $task->getBody()]);

		$stmt = $this->pdo->prepare("SELECT MAX(id) FROM tasks");
		$stmt->execute();
		$id = $stmt->fetchAll(\PDO::FETCH_ASSOC)['id'];
		return $id;
	}
} 