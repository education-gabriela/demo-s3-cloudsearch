<?php
require 'vendor/autoload.php';
//require_once('vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php');

define('ROOT', __DIR__);

use Gabidavila\S3cloudsearch\Helpers\ConfigParser;
use Gabidavila\S3cloudsearch\Databases\DbMongo;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

$config = ConfigParser::buildArray('config.yml');

$twitter_config = $config['twitter'];

$mongo = new DbMongo();
$mongo->connect();

$client = S3Client::factory(array(
    'key'    => $config['aws']['api_key'],
    'secret' => $config['aws']['api_secret'],
    'region' => $config['aws']['region'],
));

$adapter = new AwsS3Adapter($client, $config['aws']['s3_bucket']);
$filesystem = new Filesystem($adapter);
