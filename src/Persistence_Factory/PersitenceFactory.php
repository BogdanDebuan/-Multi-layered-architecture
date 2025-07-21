<?php

namespace App\Persistence_Factory;

abstract class PersitenceFactory
{
    abstract public function getDomainObject();
    abstract public function getCollection(array $row);
}