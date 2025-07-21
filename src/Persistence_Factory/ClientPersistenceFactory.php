<?php

namespace App\Persistence_Factory;


use App\Collections\ClientCollection;
use App\Domain_Object_Factory\CLientObjectFactory;
use App\Domain_Object_Factory\DomainObjectFactory;

class ClientPersistenceFactory extends PersitenceFactory
{
    public function getDomainObject()
    {
        return new ClientObjectFactory();
    }
    public function getCollection(array $row)
    {
        return new ClientCollection($row);
    }

}