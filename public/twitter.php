<?php
require_once '../bootstrap.php';

use Gabidavila\S3cloudsearch\Models\Twitter;

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location:  index.php');
}

try {
    $username = $_POST['twitter_handle'];
    $twitter = new Twitter($twitter_config);
    $save = $twitter->add($username);
    $twitter->saveTweetsToS3($filesystem, $username, 100);

    $msg = "Successfully added to <b>S3</b>";
    $color = 'success';
} catch(\Exception $e) {
    $msg = $e->getMessage();
    $color = 'danger';
}

include 'index.php';