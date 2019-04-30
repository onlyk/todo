<?php

namespace App;

class Config
{	
	public function getConfig()
	{
		$file = file_get_contents('config.json');
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

// $conf = new Config();
// print_r($conf->getConfig());