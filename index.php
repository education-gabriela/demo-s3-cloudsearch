<?php

require_once 'bootstrap.php';


use Gabidavila\S3cloudsearch\Models\Twitter;

$twitter = new Twitter($twitter_config);

$twitter->get('/statuses/user_timeline', 'screen_name=gabidavila&count=10');

