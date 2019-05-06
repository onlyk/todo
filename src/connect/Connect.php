<?php

namespace App\Connect; 

class Connect
{
	private $connect;

	public function __construct($connectString, $options)
	{	
		$this->connect = new \PDO($connectString, null, null, $options);
	}

	public static function connect($connectString, $options) : self
	{
		return new self($connectString, $options);
	}

	public function get() : \PDO
	{
		return $this->connect;
	}
}

