<?php

namespace App;

class Config
{	
	public function getConfig()
	{
		$file = file_get_contents(realpath('./../src/config.json'));
		$json = json_decode($file, true);
		return $json;
	}

	public function getDBOption()
	{
		$json = $this->getConfig();
		return $json['opt'];
	}

	public function getConnectionString()
	{
		$json = $this->getConfig();
		return $json['connect'];
	}

}