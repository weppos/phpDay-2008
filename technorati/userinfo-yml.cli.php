#!/usr/bin/env php
<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once dirname(__FILE__) . '/../spyc/spyc.php5';
require_once 'Zend/Service/Technorati.php';

// create a Zend_Service_Technorati instance
$technorati = new Zend_Service_Technorati(TECHNORATI_API_KEY);
$username   = isset($argv[1]) ? $argv[1] : 'weppos';

echo "$username:\n";

try {
    // get info about weppos author
    $result = $technorati->getInfo($username);
    
    // $username found
    echo "  status: 200\n";

    // extract the author object
    $author = $result->getAuthor();

    // echo some details
    echo "  name: " . $author->getFirstName() . ' ' . $author->getLastName() . "\n";
    echo "  desc: " . $author->getDescription() . "\n";

    // echo all blogs
    echo "  blogs:\n";
    foreach ($result->getWeblogs() as $index => $weblog) {
        echo "    blog$index:\n";
        echo "      name: " . $weblog->getName() . "\n";
        echo "      url:  " . $weblog->getUrl() . "\n";
        echo "      atom: " . $weblog->getAtomUrl() . "\n";
        echo "      rss:  " . $weblog->getRssUrl() . "\n";
    }

} catch(Zend_Service_Technorati_Exception $e) {
    if (preg_match('/invalid username/i', $e->getMessage())) {
        echo "  status: 404\n";
    } else {
        echo "  status: 500\n";
    }
        echo "  error:  " . $e->getMessage() . "\n";
}
