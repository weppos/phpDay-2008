#!/usr/bin/env php
<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once dirname(__FILE__) . '/../spyc/spyc.php5';
require_once 'Zend/Uri.php';

// get the URL from command line
$url = isset($argv[1]) ? $argv[1] : null;
$result = array();

try {
    $uri = Zend_Uri::factory($url);
    $result['uri'] = $uri->getUri();

    // use the reflection to get all getter methods
    // and invoke all methods to collect instance attributes dynamically
    $ref = new ReflectionObject($uri);
    foreach($ref->getMethods() as $method) {
        if (strpos($method->getName(), 'get') !== 0 || !$method->isPublic()) continue;
        $result[$method->getName()] = $method->invoke($uri);
    }
    
} catch (Zend_Exception $e) {
    $result['error'] = $e->getMessage();
}

echo Spyc::YAMLDump($result);
