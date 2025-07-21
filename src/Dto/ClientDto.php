<?php

namespace App\Dto;

use App\Values_Objects\ClientId;

class ClientDto
{
    public  ?string $clientId;
    public readonly string $name;
    public readonly string $login;
    public readonly string $password;

    public function __construct($array)
    {
        $this->clientId = $array['clientId'] ?? null;
        $this->name = $array['name'] ?? throw new \Exception();
        $this->login = $array['login'] ?? throw new \Exception();
        $this->password = $array['password'] ?? throw new \Exception();
    }
    public function setClientId($id)
    {
       $this->clientId = $id;
    }
}