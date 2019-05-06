<?php

namespace App\Connect;

class Config
{	
	public static function init()
	{
		return new self;
	}

	public function getConnectString() : String
	{
		$file = file_get_contents(realpath('./../config.json'));
		$params = json_decode($file, true);

		$connectString= sprintf(
				"%s:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
				$params['dbtype'],
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);

		return $connectString;
	}

	public function getOptions() : Array
	{
		$file = file_get_contents(realpath('./../config.json'));
		$params = json_decode($file, true);

		return $params['opt'];
	}
}
