<?php

namespace Yuana;

use PDO;
use NotORM;

class Database
{
    private $instance;

    public function __construct($driver, $dbhost, $dbport, $dbname, $dbuser, $dbpass, $dbdebug)
    {
        $pdo = new PDO("$driver:host=$dbhost;port=$dbport;dbname=$dbname",$dbuser, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->instance = new NotORM($pdo);
    }

    public function getInstance()
    {
        return $this->instance;
    }
}
