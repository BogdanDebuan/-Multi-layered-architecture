<?php

namespace App\Collections;

use App\Dto\ClientDto;

abstract class Collection implements \Iterator
{
    protected $total = 0;
    protected $pointer = 0;
    protected $objects = [];
    public function __construct(protected array $raw = [],protected $objectFactory = null)
    {
        $this->total = count($this->raw[0]);
    }
    public function add($object)
    {
        $this->objects[$this->total] = $object;
        $this->total++;
    }
    public function getRow($num)
    {
        $this->notifyAccess();
        if($num >= $this->total || $num < 0)
        {
            return null;
        }
        if(isset($this->objects[$num]))
        {
            return $this->objects[$num];
        }
        if(isset($this->raw[$num])){
            $this->objects[$num] = $this->objectFactoryl->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
        return null;
    }
    public function current(): mixed
    {
        return $this->getRow($this->pointer);
    }

    public function next(): void
    {
        $row = $this->getRow($this->pointer);

        if(!is_null($row)){
            $this->pointer++;
        }
    }

    public function key(): mixed
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return (! is_null($this->current()));
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}