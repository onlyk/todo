<?php

namespace App\Connect;

use App\Connect\ConnectData;

class Config
{	
	public static function getConnectionString() : String
	{
		$file = file_get_contents(realpath('./../config.json'));
		$params = json_decode($file, true);

		$connectString= sprintf("%s:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
				$params['dbtype'],
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);

		return $connectString;

	}

	public static function getOptions() : array
	{
		$file = file_get_contents(realpath('./../config.json'));
		$params = json_decode($file, true);

		return $params['opt'];
	}

}
