<?php

namespace App\Domain_Model;

use App\Collections\InvoiceCollection;
use App\Data_Mapper\ClientMapper;
use App\Data_Mapper\ObjectWatcher;
use App\Registry;
use App\Values_Objects\ClientId;
use Ramsey\Uuid\Uuid;

class Client
{
    private $invoices;
    private function __construct(
        private $ClientId,
        private $name,
        private $login,
        private $password,
    ){
        ObjectWatcher::addNew($this);
    }
    public static function create($name,$login,$password,$clientId = null)
    {

        $idcli = $clientId ?? null ;

        return new self(
            ClientId::create($idcli),
            $name,
            $login,
            $password
        );
    }
    public function getClientId()
    {
        return $this->ClientId->id;
    }
    public function getId()
    {
        return $this->ClientId;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        ObjectWatcher::addDirty($this);
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        ObjectWatcher::addDirty($this);
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getInvoices()
    {
        if(is_null($this->invoices))
        {
            $reg = Registry::instance();
            $this->invoices = $reg->getInvoiceCollection();
        }
        return $this->invoices;
    }
    public function setInvoices(InvoiceCollection $invoices)
    {
        $this->invoices = $invoices;
    }
    public function addInvoice(Invoice $invoice)
    {
        $this->getInvoices()->add($invoice);
    }
    public function getFinder()
    {
        $reg = Registry::instance();
        $clientMapper = $reg->getClientMapper();
    }
}