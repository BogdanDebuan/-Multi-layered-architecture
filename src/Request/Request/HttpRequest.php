<?php
namespace App\Request\Request;


Class HttpRequest extends Request
{
    public function initRequest()
    {
        $this->path = (!empty($_SERVER["PATH_INFO"])) ? $_SERVER["PATH_INFO"] : "/";

        $this->properties = $_REQUEST;
    }
}