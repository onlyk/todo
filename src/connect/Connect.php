<?php

namespace App\Connect; 

class Connect
{
	private $connect;

	public function __construct($connectString, $options)
	{
		$this->connect = new \PDO($connectString, null, null, $options);

	}

	public static function connect($connectString, $options)
	{
		return new self($connectString, $options);
	}

	public function get()
	{
		return $this->connect;
	}
}

