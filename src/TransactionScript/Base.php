<?php
namespace App\TransactionScript;

use App\Registry;

abstract class Base
{
    private \PDO $pdo;
    public function __construct()
    {
        $reg = Registry::instance();
        $conf = $reg->getConf();
        list($dsn,$user,$password) = [$conf->get("dsn"),$conf->get("user"),$conf->get("password")];
        $this->pdo = new \PDO($dsn,$user,$password);
    }
    public function getPDO()
    {
        return $this->pdo;
    }
}