<?php

namespace App\Domain_Model;

use App\Data_Mapper\ClientMapper;
use App\Registry;
use App\Values_Objects\ClientId;
use App\Values_Objects\InvoiceId;
use Ramsey\Uuid\Uuid;

class Invoice
{
    private $client;
    private function __construct(private $invoiceId,private $clientId,private string $name){

    }
    public static function create($clientId, $name,$invoiceId = null)
    {

    $invoice_id = $invoiceId ?? InvoiceId::create(Uuid::uuid4()->toString());

        return new self(
            $invoice_id,
            $clientId,
            $name
        );
    }
    public function getId()
    {
        return $this->invoiceId->getId();
    }
    public function getClientId()
    {
        return $this->clientId->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getClients()
    {
        $reg = Registry::instance();
        $clientMapper = $reg->getClientMapper();
        $clientCollection = $clientMapper->findByInvoice($this->clientId);
        return $clientCollection;
    }
}