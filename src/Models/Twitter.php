<?php

namespace Gabidavila\S3cloudsearch\Models;

use Gabidavila\S3cloudsearch\Databases\DbMongo;
use Aws\CloudSearch\CloudSearchClient;

class Twitter
{
    protected $config;
    protected $url_prefix;
    protected $api_exchange;
    protected $cloudsearch;

    public function __construct($twitter_config)
    {
        $this->config = $twitter_config;
        $this->url_prefix = 'https://api.twitter.com/1.1';
        $this->buildExchange();
    }

    public function buildExchange()
    {
        $this->api_exchange = new \TwitterAPIExchange($this->config);
        /*$this->cloudsearch =  $client = CloudSearchClient::factory(array(
            'key'    => $this->config['aws']['api_key'],
            'secret' => $this->config['aws']['api_secret'],
            'region' => $this->config['aws']['region'],
        ));*/
    }

    public function add($username)
    {
        if (!$username) {
            throw new \Exception('No Username Provided');
        }

        $mongo = new DbMongo();
        $mongo->connect();

        $user_data = $this->get('/users/show', '?screen_name=' . $username);
        $mongo->insert('usernames', [
            'username' => $username,
            'created_at' => DbMongo::createMongoDate(date('Y-m-d H:i:s')),
            'data' => $user_data
        ]);

        return true;
    }

    public function get($api, $q)
    {
        $url = $this->url_prefix . $api . '.json';

        return json_decode($this->api_exchange
            ->setGetfield($q)
            ->buildOauth($url, 'GET')
            ->performRequest());
    }

    public function buildDocument($tweet, $file)
    {
        $doc = [
            'screen_name' => $tweet->user->screen_name,
            'text' => $tweet->text,
            'content' => $tweet->text,
            'id' => $tweet->id,
            'file' => $file,
            'tweet' => $tweet
        ];

        $cDoc = [
            'type' => 'add',
            'id' => (int) $tweet->id,
            'fields' => $doc
        ];

        return $cDoc;
    }

    public function saveTweetsToS3($filesystem, $username, $count = 10)
    {
        $tweets = $this->get('/statuses/user_timeline', '?include_rts=true&screen_name=' . $username . '&count=' . (int)$count);

        if (count($tweets) == 0) {
            return false;
        }

        foreach ($tweets as $tw) {
            $file = '/tweets/' . $username . '/' . $tw->id . '.json';
            $exists = $filesystem->has($file);
            if (!$exists) {
                $doc = $this->buildDocument($tw, $file);
                $filesystem->write($file, json_encode($doc));
            }

        }
    }

    public function saveToCloudSearch()
    {



    }
}
