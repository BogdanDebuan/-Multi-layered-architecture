<?php

namespace App\Values_Objects;

class InvoiceId
{
    private function __construct(private string $id)
    {

    }
    public static function create($id)
    {
        return new self($id);
    }
    public function getId()
    {
        return $this->id;
    }
}