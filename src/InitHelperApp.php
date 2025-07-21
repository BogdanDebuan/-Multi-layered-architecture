<?php

namespace App;
use App\Request\Request\CLIRequest;
use App\Request\Request\HttpRequest;

class InitHelperApp
{
    private $reg;
    public function __construct()
    {
        $this->reg = Registry::instance();
    }
    public function init()
    {
        $this->parseConfig();

        if(defined("STDIN")){
            $request = new CLIRequest();
        } else {
            $request = new HttpRequest();
        }

        $this->reg->setRequest($request);
    }
    public function parseConfig()
    {
        $config_db = yaml_parse_file("config.yaml");
        $config_route = yaml_parse_file("route.yaml");

        $array = [];

        foreach ($config_route as $key => $route){
                $array[$route["path"]] = $route["controller"];
        }

        $this->reg->setController(new Conf($array));

        $this->reg->setConf(new Conf($config_db));
    }
}