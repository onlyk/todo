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
		$realpath = realpath('./../config.json');
		if (!file_exists($realpath)) {
			throw new \Exception('файл конфигурации БД отсутствует');
		}

		$file = file_get_contents($realpath);
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
		$realpath = realpath('./../config.json');
		if (!file_exists($realpath)) {
			throw new \Exception('файл конфигурации БД отсутствует');
		}
		$file = file_get_contents($realpath);
		$params = json_decode($file, true);

		return $params['opt'];
	}
}
