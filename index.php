<?php

require_once 'bootstrap.php';


use Gabidavila\S3cloudsearch\Models\Twitter;

$twitter = new Twitter($twitter);

//$twitter->get('/statuses/user_timeline', '?screen_name=gabidavila&count=2');
$twitter->add('gabidavila');

$twitter->saveTweetsToS3($filesystem, 'gabidavila', 10);