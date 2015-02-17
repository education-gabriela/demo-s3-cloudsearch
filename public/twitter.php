<?php
require_once '../bootstrap.php';

use Gabidavila\S3cloudsearch\Models\Twitter;

$username = $_POST['twitter_handle'];

$twitter = new Twitter($twitter_config);

$save = $twitter->add($username);

if($save) {
    $twitter->saveTweetsToS3($filesystem, $username, 100);
}

var_dump($save);