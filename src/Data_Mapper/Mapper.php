<?php

namespace App\Data_Mapper;

use App\Registry;

abstract class Mapper
{
    protected $pdo;
    protected $reg;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->reg = Registry::instance();
    }
    public function find($id)
    {
        $old = ObjectWatcher::exists($this->targetClass(),$id);
        if(isset($old)){
           return $old;
        }

        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch(\PDO::FETCH_ASSOC);
        $this->selectStmt()->closeCursor();

        $object = $this->doCreateObject($row);
        return $object;
    }
    public function findAll()
    {
       $this->selectAllStmt()->execute();

       $raw = $this->selectAllStmt()->fetchAll();

       $collection = $this->getCollection($raw);

       return $collection;
    }
    public function insert($object)
    {

        $this->doInsert($object);

        ObjectWatcher::add($object);
        echo "good";
        return $object;
    }
    abstract public function doInsert($obj);
    abstract public function doCreateObject($raw);
    abstract public function getCollection($raw);
    abstract public function targetClass();
}