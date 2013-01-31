<?php
namespace CentralApps\TrackerClient;

class Connection
{
	protected $apiHost;
	protected $apiKey;
	protected $accountId;
	public function __construct($account_id, $api_key, $api_host)
	{
		$this->apiHost = $api_host;
		$this->apiKey = $api_key;
		$this->accountId = $account_id;
	}
	
	public function sendPayload($payload)
	{
		$payload = array( 'payload' => $payload );
		$payload['api_key'] = $this->apiKey;
		$payload['account_id'] = $this->accountId;
		
		$curl_options = array(
			CURLOPT_URL => $this->apiHost . '/log',
    		CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => http_build_query( $payload ),
		    CURLOPT_HTTP_VERSION => 1.0,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HEADER => false
  		);

  		$curl = curl_init();
  		curl_setopt_array( $curl, $curl_options );
  		$result = curl_exec( $curl );

 		curl_close( $curl );
	}
}
