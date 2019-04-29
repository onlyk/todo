<?php


namespace todo;

class Task
{
	private $pdo;
	public function __construct()
	{
		$opt = array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
		$this->pdo = new \PDO('pgsql:host=localhost;port=5432;dbname=todo;', "postgres", "misamisa", $opt);;
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
		return "Task created. id:{$id}, name:{$name}, body:{$body}";
	}

	public function returnAllTasks()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM tasks");
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach ($result as $task) {
			$tasks .= $task['name'] . '—' . $task['body'] . PHP_EOL;
		}

		return $tasks;

	}

	public function markDone($id)
	{
		$stmt = $this->pdo->prepare("UPDATE tasks SET done = 1 
	   WHERE id = :id");

		$stmt->execute([':id' => $id]);
		return "task id:{$id}, done!";
	}

	public function deleteTask($id)
	{
		$stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
		$stmt->execute([':id' => $id]);
		return "task id:{$id} deleted =(.";
	}
}