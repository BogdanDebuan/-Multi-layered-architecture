<?php
namespace App\Controller;

use App\ResultController;
use App\Dto\DtoFactory;

class FrontController
{
    private $reg;
    private $request;
    private function __construct()
    {
       $this->reg = \App\Registry::instance();
    }
    public static function run()
    {
        $instance = new self();
        $instance->init();
        $instance->handleRequest();
    }
    public function init()
    {
        $this->reg->getInitHelperApp()->init();
    }
    public function handleRequest()
    {
        $request = $this->reg->getRequest();

        $path = $request->getPath();

        $controllerResult = new ResultController($path);

        $controller = new ($controllerResult->getController())();

        $method = $controllerResult->getMethod();

        $controller->$method();

    }
}



