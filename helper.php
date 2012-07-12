<?php

/** The password file. */
define('CHANGEME_KEYS', '/keys.private');

/** The path to your local zend framework package */
define('CHANGEME_ZFPATH', '/../gitsvn');


error_reporting(E_ALL);

// load the collection of passwords and private keys
require_once dirname(__FILE__) . CHANGEME_KEYS;

// include Zend framework
$path = array(
        dirname(__FILE__) . CHANGEME_ZFPATH . '/library/',
        dirname(__FILE__) . CHANGEME_ZFPATH . '/incubator/library/',
        get_include_path()
    );
set_include_path(implode(PATH_SEPARATOR, $path));
