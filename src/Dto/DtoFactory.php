<?php

namespace App\Dto;

use App\Registry;

class DtoFactory
{

    public static function create($dtoClass)
    {
        $registry = Registry::instance();
        $request = $registry->getRequest();
        $array = $request->getProperty();

        if(!class_exists($dtoClass)){
            throw new \Exception();
        }
        return new $dtoClass($array);
    }
}