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

	public function fromDB()
	{

	}

	public function new()
	{

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
	public function getName()
	{
		return $this->name;
	}
	public function getBody()
	{
		return $this->getBody;
	}
}

// Создать новую задачу 
// Удалить задачу
// получить задачу
// получить все задачи
// Изменить статус задачи
// Изменить содержание задачи
