<?php

namespace App\Connect; 
use App\Connect\ConnectData;

class Connect
{
	private $connect;

	public function __construct(string $connectString, array $options)
	{
		$this->connect = new \PDO($connectString, null, null, $options);
	}

	public static function connect(string $connectString, array $options) : self
	{
		return new self($connectString, $options);
	}

	public function get() : \PDO
	{
		return $this->connect; // ЭТО ТОЧНО НЕ МУТАБЕЛЬНО?!
	}

}
