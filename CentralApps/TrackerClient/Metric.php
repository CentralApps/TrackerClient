<?php
namespace CentralApps\TrackerClient;

class Metric
{
	public $reference;
	public $created;
	public $removed = '0000-00-00 00:00:00';
	public $type=0;
	public $typeReference='';
	public $tags = array();
	
	public function __construct()
	{
		$this->created = date('Y-m-d H:i:s');
	}
}
