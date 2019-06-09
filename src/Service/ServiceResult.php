<?php

namespace App\Service;

class ServiceResult{

	private $status;
	private $data;

	public function __construct($status, $data)
	{
		$this->status = $status;
		$this->data = $data;

		public function getStatus()
		{
			return $this->status;
		}

		public function getData()
		{
			return $this->data;
		}
	}
}