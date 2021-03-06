<?php

namespace App\Repository;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\Entity\TaskData;
use App\Repository\RepositoryResult;
use App\Repository\RepositoryFindAllResult;

class TaskRepository
{
	private $pdo;

	public function __construct($connect)
	{
		$this->pdo = $connect;
	}

	public function find($uuid) : RepositoryResult
	{
		$stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE uuid = :uuid");
		$stmt->execute([':uuid' => $uuid]);
		$data = $stmt->fetch(\PDO::FETCH_ASSOC);

		if (!$data) {
			$errors[] = 'not found';
			return new RepositoryResult($errors, null);
		}

		$taskData = new TaskData(
			Uuid::fromString($data['uuid']),
			$data['name'], 
			$data['body'], 
			$data['status']
		);

		return new RepositoryResult(null, $taskData);
	}

	public function findAll() : RepositoryFindAllResult
	{
		$stmt = $this->pdo->prepare("SELECT * FROM tasks");
		$stmt->execute();
		$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if (!$data) {
			$errors[] = 'not found';
			return new RepositoryFindAllResult($errors, null);
		}

		return new RepositoryFindAllResult(null, $data);
	}

	public function store($taskData)
	{
	$stmt = $this->pdo->prepare("INSERT INTO tasks(uuid, name, body, status) 
								VALUES (:uuid, :name, :body, :status)");
	$stmt->execute([
		':uuid' => $taskData->uuid, 
		':name' => $taskData->name, 
		':body' => $taskData->body, 
		':status' => $taskData->status
	]);
	}
	
	public function update($taskData)
	{
		$stmt = $this->pdo->prepare("UPDATE tasks SET 
			name = :name, 
			body = :body, 
			status = :status 
			WHERE uuid = :uuid");
		$stmt->execute([
			':uuid' => $taskData->uuid, 
			':name' => $taskData->name, 
			':body' => $taskData->body, 
			':status' => $taskData->status
		]);
	}
	
	public function delete($uuid) 
	{
		$stmt = $this->pdo->prepare("DELETE FROM tasks WHERE uuid = :uuid");
		$stmt->execute([':uuid' => $uuid]);
	}

} 