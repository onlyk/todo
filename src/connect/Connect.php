<?php

namespace App\Connect; 
use App\Connect\ConnectData;
class Connect
{
	private $connect;

	public function __construct($connectString)
	{
		$this->connect = new \PDO($connectString);
	}

	public static function connect($connectString)
	{
		return new self($connectString);
	}

	public function get() {
		return $this->connect; // ЭТО ТОЧНО НЕ МУТАБЕЛЬНО?!
	}

}
