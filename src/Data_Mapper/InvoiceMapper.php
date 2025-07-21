<?php

namespace App\Data_Mapper;

use App\Domain_Model\Invoice;

class InvoiceMapper extends Mapper
{
    private \PDOStatement $selectStmt;
    private \PDOStatement $updateStmt;
    private \PDOStatement $insertStmt;
    private \PDOStatement $selectAllStmt;
    public function __construct($pdo)
    {
        parent::__construct($pdo);

        $this->selectAllStmt = $this->pdo->prepare("SELECT * from invoice");

        $this->selectStmt = $this->pdo->prepare("SELECT * from invoice where id = ?");

        $this->insertStmt = $this->pdo->prepare("INSERT INTO invoice (id,client_id,name) values (?,?,?)");

        $this->updateStmt = $this->pdo->prepare("UPDATE invoice set id =  ?, set client_id = ?, set name = ? where id = ?");
    }
    public function doInsert($obj)
    {
        $this->insertStmt->execute([$obj->getId(),$obj->getClientId(),$obj->getName()]);
    }
    public function selectAllStmt()
    {
        return $this->selectAllStmt;
    }
    public function getCollection($raw)
    {
       $collection = $this->reg->getInvoiceCollection($raw,$this);

       return $collection;
    }
    public function doCreateObject($raw)
    {
        $invoice = Invoice::create($raw["client_id"],$raw["name"],$raw["id"]);
        return $invoice;
    }
    public function targetClass()
    {
         return Invoice::class;
    }
}