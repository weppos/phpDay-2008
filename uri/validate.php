<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once 'Zend/Uri.php';

$url = 'http://www.simonecarletti.com/';

// simple $url validation, print the result of validation
echo "Validating `$url`: ";
echo Zend_Uri::check($url) ? "valid" : "invalid";
echo "\n";
