<?php
namespace CentralApps\TrackerClient;

class Metric
{
	public $reference;
	public $created = '0000-00-00';
	public $removed = '0000-00-00 00:00:00';
	public $objectType;
	public $tags = array();
}
