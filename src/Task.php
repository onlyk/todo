<?php


namespace todo;

class Task
{
	private $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
	public function getNextId()
	{
		$stmt = $this->pdo->prepare('SELECT id FROM tasks WHERE id=(SELECT MAX(id) FROM tasks)');
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return ($result[0]['id'] ?? 0) + 1;
	}

	public function createTask($name, $body)
	{
		$id = $this->getNextId();
		$stmt = $this->pdo->prepare("INSERT INTO tasks (name, id, body, done) VALUES (:name, :id, :body, 0)");
		$stmt->execute([':name' => $name, ':id' => $id, ':body' => $body]);
	}

	public function returnAllTasks()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM tasks");
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($result as $task) {
			echo $task['name'] . '—' . $task['body'] . '<br>';
		}

	}

	public function markDone($id)
	{
		$stmt = $this->pdo->prepare("UPDATE tasks SET done = 1 
	   WHERE id = :id");

		$stmt->execute([':id' => $id]);
	}

	public function deleteTask($id)
	{
		$stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
		$stmt->execute([':id' => $id]);
	}
}