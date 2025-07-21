<?php
namespace App;


class ResultController
{
    private $path;
    private $controllerArray;
    public function __construct($path)
    {
        $this->reg = Registry::instance();

        $request = $this->reg->getRequest();

        $controllerResult = $this->reg->getController();

        $contoller = $controllerResult->get($path);

        $this->controllerArray = explode("::",$contoller);

    }
    public function getController()
    {
        return "App\\Controller\\" .$this->controllerArray[0];
    }
    public function getMethod()
    {
        return $this->controllerArray[1];
    }
}