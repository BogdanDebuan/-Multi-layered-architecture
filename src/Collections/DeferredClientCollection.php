<?php
namespace App\Collections;

class DeferredClientCollection extends ClientCollection
{
    private $run = false;
    public function __construct(
        $mapper,
        private $stmt,
        private $valueArray
    )
    {
        parent::__construct([],$mapper);
    }
    public function notifyAccess()
    {
        if(!$this->run){
            $this->stmt->execute($this->valueArray);
            $this->raw = $this->stmt->fetchAll();
            $this->total = count($this->raw);
        }
        $this->run = true;
    }
}