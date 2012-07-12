<?php

require_once dirname(__FILE__) . '/../helper.php';
require_once dirname(__FILE__) . '/../spyc/spyc.php5';
require_once 'Zend/Service/Akismet.php';

// load comment fixtures from yaml file
$file = dirname(__FILE__) . '/isspam.yml';
$comments = Spyc::YAMLLoad($file);

// create a Akismet client instance
$akismet  = new Zend_Service_Akismet(AKISMET_API_KEY, 'http://www.simonecarletti.com/blog');

// batch check comments
echo "Starting batch: " . count($comments) . " comment(s) to check from $file";
echo "\n";

// loop over all $comments and do some stuff
foreach ($comments as $comment) {
    echo "\nChecking comment from {$comment['comment_author']} ({$comment['comment_author_email']})... ";
    $spam = $akismet->isSpam($comment);
    echo "\n  Permalink: " . $comment['permalink'];
    echo "\n  Referrer:  " . $comment['referrer'];
    echo "\n  Akismet:   " . ($spam ? 'spam' : 'ham');
    echo "\n";
}

// The end...
echo "\nCompleted!";
echo "\n";