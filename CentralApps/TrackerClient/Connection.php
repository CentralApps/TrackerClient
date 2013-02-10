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
		$to_send = array();
		foreach($payload as $data) {
			$send = array();
			$send['reference'] = $data->reference;
			$send['object_type'] = $data->type;
			$send['object_type_reference'] = $data->objectTypeReference;
			$send['created'] = $data->created;
			$send['removed'] = $data->removed;
			$send['tags'] = implode(',',$data->tags);
			$to_send[] = $send;
		}
		$payload = array( 'payload' => $to_send );
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
		$err = curl_errno ( $curl );
      	$errmsg = curl_error ( $curl );
      	$header = curl_getinfo ( $curl );
      	$http_code = curl_getinfo ( $curl, CURLINFO_HTTP_CODE );
 		curl_close( $curl );
		if(200 == $http_code) {
			return true;
		} else {
			throw new \Exception("Problem logging metrics");
		}
	}
}
