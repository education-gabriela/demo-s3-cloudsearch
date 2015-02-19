<?php
require_once '../bootstrap.php';

use Gabidavila\S3cloudsearch\Models\Twitter;

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location:  index.php');
}

try {
    $username = $_POST['twitter_handle'];
    $twitter = new Twitter($config);
    $save = $twitter->add($username);
    $twitter->saveTweetsToS3($filesystem, $username, 15);

    $msg = "Successfully added to <b>S3</b> and <b>Cloudsearch</b>";
    $color = 'success';
} catch(\Exception $e) {
    $msg = "<b>{$e->getCode()}</b>: ".$e->getMessage();
    $msg = $msg .= "<pre>".$e->getFile()."</pre>";
    $msg .= "<pre>".$e->getTraceAsString()."</pre>";
    $color = 'danger';
}

include 'index.php';