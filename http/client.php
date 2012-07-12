<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once 'Zend/Http/Client.php';

$url = 'http://www.simonecarletti.com/';

// create a new http client instance 
// and initialize it with a few common settings
$client = new Zend_Http_Client();
$client->setUri($url)
       ->setConfig(array(
        'useragent'    => 'phpDay 2008',
        'maxredirects' => 0,
        'httpversion'  => '1.1',
       ));

try {
    echo "Fetching $url... \n";
    $response = $client->request();
    
    // get the URI again, it might not be the original one
    // due to an HTTP redirect
    $uri = $client->getUri();
    
} catch (Zend_Exception $e) {
    die('Execution failed: ' . $e->getMessage());
}

// print the output as valid YAML content
echo "{$uri->__toString()}:\n";
echo "  Status: " . $response->getStatus() . "\n";
echo "  Headers:\n";
foreach($response->getHeaders() as $name => $value) {
    echo "    $name: $value\n";
}
