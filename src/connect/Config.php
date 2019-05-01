<?php

namespace App\Connect;

use App\Connect\ConnectData;

class Config
{	
	public static function get() : ConnectData
	{
		$file = file_get_contents(realpath('./../config.json'));
		$params = json_decode($file, true);

		$connection = new ConnectData($params['opt'], $params['dbtype'], $params['host'], $params['port'], $params['database'], $params['user'], $params['password']);

		return $connection;

	}

}

