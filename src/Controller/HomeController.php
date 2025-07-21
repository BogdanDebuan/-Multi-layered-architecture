<?php

namespace App\Controller;

use App\Data_Mapper\ObjectWatcher;
use App\Registry;
use App\Domain_Model\Client;

class HomeController
{
    private $reg;
    private $property;

    public function __construct()
    {
        $this->reg = Registry::instance();
        $this->property = $this->reg->getRequest();
    }

    public function clientController()
    {

        $client = Client::create("Bogdan1","Bogdanufa2006@gmail.com",123456789);

        ObjectWatcher::performOperation();


    }
}