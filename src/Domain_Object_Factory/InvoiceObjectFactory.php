<?php

namespace App\Domain_Object_Factory;
use App\Domain_Model\Invoice;

class InvoiceObjectFactory extends DomainObjectFactory
{
    public function getCreateObject($row)
    {
       $invoice = Invoice::create($row["client_id"],$row["name"],$row["id"]);
       return $invoice;
    }

}