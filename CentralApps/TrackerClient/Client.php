<?php
namespace CentralApps\TrackerClient;

class Client
{
	
	protected $metrics = array();
	protected $connection;
	
	public function __construct($account_id, $api_key, $api_host='')
	{
		$this->connection = new Connection($account_id,$api_key,$api_host);
		$client = $this;
		register_shutdown_function(function() use ($client) {
			$client->sendMetrics();
		});
	}
	
	public function logMetric(Metric $metric)
	{
		$this->metrics[] = $metric;
	}
	
	public function sendMetrics()
	{
		try {
			$this->connection->sendPayload($this->metrics);
		} catch(\Exception $e) {
			//
		}
		
	}
}
