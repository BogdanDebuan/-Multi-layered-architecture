<?php

namespace App\Domain_Object_Factory;

use App\Data_Mapper\ObjectWatcher;
use App\Domain_Model\Client;
use App\Values_Objects\ClientId;

class CLientObjectFactory extends DomainObjectFactory
{
    public function getCreateObject($row)
    {
        $clientId = ClientId::create($row["id"]);

        $client = Client::create($row["name"],$row["login"],$row["password"],$clientId);

        ObjectWatcher::add($client);

        return $client;
    }
}