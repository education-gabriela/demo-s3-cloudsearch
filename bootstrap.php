<?php
require 'vendor/autoload.php';
//require_once('vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

define('ROOT', __DIR__);

use Gabidavila\S3cloudsearch\Helpers\ConfigParser;
use Gabidavila\S3cloudsearch\Databases\DbMongo;

$twitter_config = ConfigParser::buildArray('config.yml');
$twitter_config = $twitter_config['twitter'];

$mongo = new DbMongo();
$mongo->connect();