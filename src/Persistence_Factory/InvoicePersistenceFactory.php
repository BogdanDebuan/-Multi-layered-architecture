<?php

namespace App\Persistence_Factory;


use App\Collections\InvoiceCollection;
use App\Domain_Object_Factory\InvoiceObjectFactory;
use App\Domain_Object_Factory\DomainObjectFactory;

class InvoicePersistenceFactory extends PersitenceFactory
{
    public function getDomainObject()
    {
        return new InvoiceObjectFactory();
    }
    public function getCollection(array $row)
    {
       return new InvoiceCollection($row);
    }
}