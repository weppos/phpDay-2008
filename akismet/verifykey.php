<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once 'Zend/Service/Akismet.php';

// required: the blog URI
$blog = 'http://www.simonecarletti.com/blog';

// create a new Akismet client instance
$akismet = new Zend_Service_Akismet(AKISMET_API_KEY, $blog);

// verify key and print a notification
if ($akismet->verifyKey()) {
    echo "Key is valid.\n";
} else {
    echo "Key is not valid\n";
}
