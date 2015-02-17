<?php

namespace Gabidavila\S3cloudsearch\Models;

use Gabidavila\S3cloudsearch\Databases\DbMongo;

class Twitter
{
    protected $config;
    protected $url_prefix;
    protected $api_exchange;

    public function __construct($twitter_config)
    {
        $this->config = $twitter_config;
        $this->url_prefix = 'https://api.twitter.com/1.1';
        $this->buildExchange();
    }

    public function buildExchange()
    {
        $this->api_exchange = new \TwitterAPIExchange($this->config);
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

    public function call($url, $requestMethod)
    {


    }

    public function saveTweetsToS3($filesystem, $username, $count = 10)
    {
        $tweets = $this->get('/statuses/user_timeline', '?include_rts=true&screen_name=' . $username . '&count=' . (int)$count);

        if (count($tweets) == 0) {
            return false;
        }


//var_dump($tweets);die;

        foreach ($tweets as $tw) {
            $file = '/tweets/' . $username . '/' . $tw->id . '.json';
            $exists = $filesystem->has($file);
            if (!$exists) {
                $filesystem->write($file, json_encode($tw));
            }

        }
    }
}
