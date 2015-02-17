<?php

namespace Gabidavila\S3cloudsearch\Databases;

use Gabidavila\S3cloudsearch\Helpers\ConfigParser;

class DbMongo
{
    protected $mongo;
    protected $db;

    public function connect()
    {
        $db_config = ConfigParser::buildArray('database.yml');
        $db_config = $db_config['mongodb'];

        $dsn = 'mongodb://%s:%s';
        $dsn = sprintf($dsn, $db_config['hostname'], $db_config['port']);

        $this->mongo = new \MongoClient($dsn);
        $this->mongo->selectDB($db_config['database']);
        $this->db = $db_config['database'];

        return $this->mongo;
    }

    public function insert($collection_name, $array)
    {
        $db = $this->db;
        $collection = $this->mongo->$db->$collection_name;
        $collection->insert($array);
    }

    public function batchInsert($collection_name, $array)
    {
        $db = $this->db;
        $collection = $this->mongo->$db->$collection_name;
        $collection->batchInsert($array);
    }
}
