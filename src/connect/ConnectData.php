<?php

namespace App\Connect;

class ConnectData
{
	public $opt;
	public $dbtype;
	public $host;
	public $port;
	public $database;
	public $user;
	public $password;

	public function __construct(array $opt, string $dbtype, string $host, int $port, string $database, string $user, string $password)
	{
		$this->opt = $opt;
		$this->dbtype = $dbtype;
		$this->host = $host;
		$this->port = (int) $port;
		$this->database = $database;
		$this->user = $user;
		$this->password = $password;
	}
}