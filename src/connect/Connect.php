<?php

namespace App\Connect; 

class Connect
{
	private $connect;

	public function __construct($connectString, $options)
	{	
		$this->connect = new \PDO($connectString, null, null, $options);
	}

	public function get() : \PDO
	{
		return $this->connect;
	}
}

