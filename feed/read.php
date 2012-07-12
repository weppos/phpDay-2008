<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once 'Zend/Feed.php';

// try to fetch the latest posts
try {
    
    // import the feed, regardless the format
    $feed = Zend_Feed::import('http://www.zend-framework.it/feed');
    
    // loop all items
    foreach($feed as $index => $item) {
        echo "$index.\n";
        echo "  Title: {$item->title()}\n";
        echo "  Link:  {$item->link()}\n";
        echo "  Desc:  {$item->description()}\n";
        echo "\n";
    }

// something went wrong, display the error message
} catch (Zend_Feed_Exception $e) {
    echo "Aaaargh! The script crashed: " . $e->getMessage();
}