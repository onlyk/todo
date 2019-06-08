<?php

namespace App\Connect;

class Config
{	
	private $config;
	private $options;

	private function __construct()
	{
		$realpath = realpath('./../config.json');
		if (!file_exists($realpath)) {
				throw new \Exception('файл конфигурации БД отсутствует');
		}

		$file = file_get_contents($realpath);
		$params = json_decode($file, true);

		$this->config = sprintf(
				"%s:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
				$params['dbtype'],
                $params['host'], 
                $params['port'], 
                $params['database'], 
                $params['user'], 
                $params['password']);

		$this->options = $params['opt']
	}

	public static function init() : self
	{
		return new self;
	}

	public function getConnectString() : array
	{
		return $this->config;
	}
	
	public function getOptions() : array
	{
		return $this->options;
	}
}
