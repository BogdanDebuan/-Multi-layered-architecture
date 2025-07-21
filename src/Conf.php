<?php

namespace App;
class Conf
{
    private $conf;
    public function __construct($conf)
    {
        $this->conf = $conf;
    }
    public function set($value)
    {
        $this->conf = $value;
    }
    public function get($key)
    {
        return $this->conf[$key];
    }
}