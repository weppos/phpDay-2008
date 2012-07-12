#!/usr/bin/env php
<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once dirname(__FILE__) . '/../spyc/spyc.php5';
require_once 'Zend/Http/Client.php';

// load from the YAML file the list of hosts to verify
$file   = dirname(__FILE__) . '/sites.yml';
$sites  = Spyc::YAMLLoad($file);
$result = array();

// create and initialize a new HTTP client
$client = new Zend_Http_Client();
$client->setConfig(array(
        'useragent'    => 'phpDay 2008',
        'maxredirects' => 0,
        'timeout'      => 10,
        'httpversion'  => '1.1',
       ));

// check all $sites
foreach ($sites as $name => $site) {
    $report = array();
    $report['request']  = array();
    $report['response'] = array();
    
    try {
        // overwrite default config with specific config
        if (isset($site['config'])) {
            $client->setConfig((array) $site['config']);
        } 
        
        // overwrite default headers with specific headers
        if (isset($site['headers'])) {
            $client->setConfig((array) $site['headers']);
        }

        // set the URI to verify
        if (isset($site['url'])) {
            $client->setUri((string) $site['url']);
        }
        else {
            throw new Exception("Hey dude, you forgot the URL for `$name`!");
        }
        $report['request']['uri'] = $client->getUri()->getUri();
        
        // run an HTTP HEAD request
        $response = $client->request(Zend_Http_Client::HEAD);
        $report['response']['status']  = $response->getStatus();
        $report['response']['headers'] = $response->getHeaders();
        
    } catch (Zend_Http_Exception $e) {
        $report['response']['error']  = $e->getMessage();
    } catch (Exception $e) {
        $report['error'] = $e->getMessage();
    }

    $result[$name] = $report;
}

// flush the output as YAML content
echo Spyc::YAMLDump($result);
