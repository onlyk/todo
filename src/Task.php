<?php


namespace App;

class Task
{
	private $id;
	private $name;
	private $body;
	private $status;

	public function __construct($id, $name, $body, $status)
	{
		$this->id = $id;
		$this->name = $name;
		$this->body = $body;
		$this->status = $status;
	}
	
	public function __toString()
	{
		return $this->id . ": " .$this->name . ": " . $this->body . ": ". $this->status;
	}

	public function fromDB($id)
	{
		$repo = new TaskRepository();
		$task = $repo->find($id);
		$id = $id;
		$name = $task['name'];
		$body = $task['body'];
		$status = $task['status'];
		return new Task($id, $name, $body, $status);
	}

	public function updateBody($body)
	{

	}

	public function statusDone()
	{

	}

	public function statusCancel()
	{

	}

	public function statusResume()
	{

	}
	public function getName() { return $this->name; }
	public function getBody() { return $this->body; }
	public function getId() { return $this->id; }
	public function getStatus() { return $this->status; }
}

// Создать новую задачу 
// Удалить задачу
// получить задачу
// получить все задачи
// Изменить статус задачи
// Изменить содержание задачи
