# Tracker Client

This tool is a PHP based client for a metric tracking server, which is currently in beta-testing stage.

## Installation

Install via composer.  In your composer.json file add to the requires section

	"centralapps/tracker-client": "dev-master"
	
Run composer

	php composer.phar update

## Usage

	$client = new \CentralApps\TrackerClient\Client(YOUR_ACCOUNT_ID, YOUR_API_KEY, YOUR_METRIC_SERVER_URL);
	$metric = new \CentralApps\TrackerClient\Metric();
	$metric->typeReference = 'user';
	$metric->created = date('Y-m-d H:i:s'); // date user added
	$metric->reference = 1; // a unique reference for this "user"
	$metric->tags = array('some', 'tag', 'pretend');
	
	$client->logMetric($metric);
	
	$metric = new \CentralApps\TrackerClient\Metric();
	$metric->typeReference = 'user';
	$metric->reference = 1;
	$metric->created = date('Y-m-d H:i:s'); // if object exists, this becomes the updated date
	$metric->tags = array('some', 'tag', 'pretend', 'paid', '50GBP');
	
	$client->logMetric($metric);
	
	$metric = new \CentralApps\TrackerClient\Metric();
	$metric->typeReference = 'user';
	$metric->reference = 1;
	$metric->removed = date('Y-m-d H:i:s');
	$metric->created = date('Y-m-d H:i:s'); // date the user was removed from site
	$metric->tags = array('some', 'tag', 'pretend', 'paid', '50GBP', 'cancelled');
	
	$client->logMetric($metric);

## Notes

The client library binds itself with PHP's register_shutdown_function, so the outbound curl request will not interfere with your users requests.