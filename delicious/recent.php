<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once dirname(__FILE__) . '/../spyc/spyc.php5';
require_once 'Zend/Service/Delicious.php';

// create a new Delicious client instance
$delicious  = new Zend_Service_Delicious(DELICIOUS_USERNAME, DELICIOUS_PASSWORD);

// fetch all recent posts
$posts      = $delicious->getRecentPosts();

echo "Found " . count($posts) . " post(s)\n";
echo "\n";

// loop over all $posts
foreach ($posts as $index => $post) {
    echo "$index.\n";
    echo "  Title: {$post->getTitle()}\n";
    echo "  Url:   {$post->getUrl()}\n";
    echo "  Desc:  {$post->getNotes()}\n";
}
