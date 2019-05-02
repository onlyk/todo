<?php

namespace App;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class TaskRepository
{
	private $pdo;
	public function __construct($connect)
	{
		$this->pdo = $connect;
	}

	public static function create($connect)
	{

		return new self($connect);
	}

	public function find($id)
	{
	
	}

	public function findAll()
	{
	}

	public function store($taskData)
	{
	$uuid4 = Uuid::uuid4();
	var_dump($this->pdo);
	$stmt = $this->pdo->prepare("INSERT INTO tasks(uuid, name, body, status) VALUES (:uuid, :name, :body, :status)");
	$stmt->execute([':uuid' => $uuid4, ':name' => 'qwe', ':body' => 'qwe', ':status' => 'qweqwe']);

		return 'work';

	}

} 