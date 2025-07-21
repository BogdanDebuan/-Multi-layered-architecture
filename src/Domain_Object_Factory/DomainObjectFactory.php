<?php

namespace App\Domain_Object_Factory;

abstract class DomainObjectFactory
{
    abstract public function getCreateObject($row);
}