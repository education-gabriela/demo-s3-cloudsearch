<?php

namespace Gabidavila\S3cloudsearch\Models;

class Twitter
{
    protected $config;
    protected $url_prefix;

    public function __construct($twitter_config)
    {
        $this->config = $twitter_config;
        $this->url_prefix = 'https://api.twitter.com/1.1/';
    }

    public function add($username)
    {
        if(!$username) {

        }
    }

    public function get($api, $q)
    {
        $url = $this->url_prefix.'/'.$api.'.json?'.$q;
        var_dump($url);
        $this->call($url, 'GET');
    }

    public function call($url, $requestMethod){
        $twitter = new \TwitterAPIExchange($this->config);
        echo $twitter->buildOauth($url, $requestMethod)
            ->performRequest();
    }
}

/*$mongo = new DbMongo();
$mongo->connect();*/