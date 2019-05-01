<?php

namespace App\Connect;

class ConnectionData
{
	public array $opt;
	public string $dbtype;
	public int $host;
	public string $port;
	public string $database;
	public string $user;
	public string $password;

	public function __construct(array $opt, string $dbtype, int $host, string $port, string $database, string $user, string $password)
	{
		$this->opt = $opt;
		$this->dbtype = $dbtype;
		$this->host = $host;
		$this->port = $port;
		$this->database = $database;
		$this->user = $user;
		$this->password = $password;
	}
}