<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once 'Zend/Service/Technorati.php';

// create a Zend_Service_Technorati instance
$technorati = new Zend_Service_Technorati(TECHNORATI_API_KEY);
$username   = 'weppos';

echo "Seeking information about $username... ";

try {
    // get info about weppos author
    $result = $technorati->getInfo($username);
    
    // $username found
    echo "found! :)\n";

    // extract the author object
    $author = $result->getAuthor();

    // echo some details
    echo "  Name: " . $author->getFirstName() . ' ' . $author->getLastName() . "\n";
    echo "  Desc: " . $author->getDescription() . "\n";
    echo "\n";

    // echo all blogs
    echo "Blogs authored by " . $username . "\n";
    foreach ($result->getWeblogs() as $weblog) {
        echo "  " . $weblog->getName() . "\n";
    }
    echo "\n";    

} catch(Zend_Service_Technorati_Exception $e) {
    if (preg_match('/invalid username/i', $e->getMessage())) {
        echo "not found! :(\n";
    } else {
        echo "error!\n";
        echo "Something went wrong: " . $e->getMessage();
    }
}
