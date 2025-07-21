<?php

namespace App\Request\Request;
class Request
{
    protected $path;
    protected $properties;
    protected $feedback;
    public function __construct()
    {
        $this->initRequest();
    }
    public function setPath($path)
    {
        $this->path = $path;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getProperty($key)
    {
       return $this->properties[$key];
    }
    public function setProperty($key,$val)
    {
        $this->properties[$key] = $val;
    }
    public function addFeedback($msg)
    {
        $this->feedback[] = $msg;
    }
    public function getFeedback()
    {
        return $this->feedback;
    }
}