<?php

namespace Noem;
require "vendor/autoload.php";

use \PDO;

class Database 
{    
    protected $db;

    public function __construct()
    {
        $config = file_get_contents(dirname(__DIR__) . '/example/config/config.json');
        $host = json_decode($config);
        
        $this->db = new PDO('mysql:host=' . $host->host . ';dbname=' . $host->name . ';charset=utf8;', $host->user, $host->pass);
    }
}