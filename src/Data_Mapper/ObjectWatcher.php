<?php

namespace App\Data_Mapper;

class ObjectWatcher
{
    private array $all = [];
    private array $dirty = [];
    private array $new = [];
    private array $delete = [];
    private static $instance;
    private function __construct()
    {

    }
    public static function instance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
            return self::$instance;
    }
    public function globalkey($object)
    {
        return get_class($object).".".$object->getClientId();
    }
    public static function add($object)
    {
        $inst = self::instance();
        $inst->all[$inst->globalkey($object)] = $object;
        return $inst->all;
    }
    public static function exists($classname,$id)
    {
        $inst = self::instance();
        $key = $classname. "." .$id;
        if(isset($inst->all[$key])){
            return $inst->all[$key];
        }
        return null;
    }
    public static function addDirty($obj)
    {
        $inst = self::instance();
        if(!in_array($obj,$inst->new,true)){
            $inst->dirty[$inst->globalkey($obj)] = $obj;
        }
    }
    public static function addNew($obj)
    {
        $inst = self::instance();

        $inst->new[] = $obj;
    }
    public function addClean($obj)
    {
        $inst = new self();
        unset($inst->dirty[$inst->globalkey($obj)]);
    }
    public static function performOperation()
    {
        $inst = self::instance();

        foreach ($inst->dirty as $key => $obj){
            $obj->getFinder()->update($obj);
        }
        foreach ($inst->new as $key => $obj){
            $obj->getFinder()->insert($obj);
        }
    }
}
