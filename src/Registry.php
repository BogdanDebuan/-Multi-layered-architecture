<?php
namespace App;
use App\Collections\ClientCollection;
use App\Collections\InvoiceCollection;
use App\Data_Mapper\ClientMapper;
use App\Data_Mapper\InvoiceMapper;

class Registry
{
    private $conf;
    private static $instance;
    private $request;
    private $command;
    private $controller;
    private $pdo;
    private $clientMapper;
    private $invoiceMapper;
    private $clientCollection;
    public static function instance()
    {
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
            return self::$instance;
    }
    public function setConf(Conf $conf)
    {
        $this->conf = $conf;
    }
    public function getConf()
    {
        return $this->conf;
    }
    public function getInitHelperApp()
    {
        return new InitHelperApp();
    }
    public function setRequest($request)
    {
        $this->request = $request;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function setController(Conf $commands)
    {
        $this->controller = $commands;
    }
    public function getController()
    {
        return $this->controller;
    }
    public function getPDO()
    {
        if(is_null($this->pdo)){
            $this->pdo = new \PDO($this->conf->get("dsn"),$this->conf->get("user"),$this->conf->get("password"));
        }
            return $this->pdo;
    }
    public function getClientMapper()
    {
            return $this->clientMapper = new ClientMapper($this->getPDO());
    }
    public function getClientCollection($raw,$mapper)
    {
        if(is_null($this->clientCollection)){
            $this->clientCollection = new ClientCollection($raw,$mapper);
        }
        return $this->clientCollection;
    }
    public function getInvoiceCollection($raw,$mapper)
    {
        return new InvoiceCollection($raw,$mapper);
    }
    public function getInvoiceMapper()
    {
        if(is_null($this->invoiceMapper)){
            $this->invoiceMapper = new InvoiceMapper($this->getPDO());
        }
        return $this->invoiceMapper;
    }
}