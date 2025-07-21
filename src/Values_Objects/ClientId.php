<?php

namespace App\Values_Objects;


use Ramsey\Uuid\Uuid;

class ClientId
{
    private function __construct(public $id)
    {
       $this->id = $this->validate($this->id);
    }
    public static function create($id)
    {
       return new self(
          $id
       );
    }
    public function validate($id)
    {
        if(is_null($id)){
           return $this->id = Uuid::uuid4()->toString();
        }
        return $this->id;
    }
    public function getClientId()
    {
        return $this->id;
    }
}

