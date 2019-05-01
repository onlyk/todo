<?php

namespace App\Connect; 
use App\Connect\ConnectData;
class Connect
{
	private $connect;

	public function __construct()
	{
		
	}

	public function connect($connectData)
	{
		$connectString = sprintf("%s:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
				$connectData->dbtype,
                $connectData->host, 
                $connectData->port, 
                $connectData->database, 
                $connectData->user, 
                $connectData->password);
		$this->connect = new \PDO($connectString);
		return $this->connect; // спросить про мутабельность
	}

	public static function get() {
		return new self();
	}

}
