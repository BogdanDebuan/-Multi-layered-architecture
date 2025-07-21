<?php
namespace App\Data_Mapper;


use App\Collections\ClientCollection;
use App\Collections\Collection;
use App\Collections\DeferredClientCollection;
use App\Domain_Model\Client;
use App\Dto\ClientDto;
use App\Values_Objects\ClientId;

class ClientMapper extends Mapper
{
    private \PDOStatement $selectStmt;
    private \PDOStatement $insertStmt;
    private \PDOStatement $updateStmt;
    private \PDOStatement $selectAllStmt;
    public function __construct($pdo)
    {
        parent::__construct($pdo);

        $this->selectStmt = $this->pdo->prepare("SELECT * from client where id=?");
        $this->insertStmt = $this->pdo->prepare("INSERT INTO client values (?,?,?,?)");
        $this->updateStmt = $this->pdo->prepare("UPDATE client SET name = ?,login = ?,password = ?, id = ? where id = ?");
        $this->selectAllStmt = $this->pdo->prepare("SELECT * from client");
        $this->findByInvoice = $this->pdo->prepare("SELECT * from client where id = ?");
    }
    public function doInsert($client)
    {
        $values = [$client->getClientId(),$client->getName(),$client->getLogin(),$client->getPassword()];
        $this->insertStmt->execute($values);
    }
    public function update($client)
    {
        $values = [
          $client->getName(),
          $client->getLogin(),
          $client->getPassword(),
          $client->getId(),
          $client->getId()
        ];

        $this->updateStmt->execute($values);
    }
    public function selectStmt()
    {
        return $this->selectStmt;
    }
    public function selectAllStmt()
    {
        return $this->selectAllStmt;
    }
    public function doCreateObject($client)
    {
        ObjectWatcher::exists();

        $clientId = ClientId::create($client["id"]);

        $client = Client::create($client["name"],$client["login"],$client["password"],$clientId);

        ObjectWatcher::add($client);

        return $client;
    }
    public function getCollection($raw)
    {
        $collection = $this->reg->getClientCollection($raw,$this);
        return $collection;
    }
    public function findByInvoice($client_id)
    {
        return new DeferredClientCollection(
            $this,
            $this->findByInvoice,
            [$client_id]
        );
    }
    public function targetClass()
    {
        return Client::class;
    }
}
