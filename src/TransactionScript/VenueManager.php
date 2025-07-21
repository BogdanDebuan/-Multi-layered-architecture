<?php
namespace App\TransactionScript;

class VenueManager extends Base
{
    private $addvenue = "INSERT INTO venue (name) values (?)";
    private $addspace = "INSERT INTO space (venue,name) values (?,?)";
    private $bookevent = "INSERT INTO event (name,start,duration,space_id) values (?,?,?,?)";
    public function addVenue($name,$spaces)
    {
        $pdo = $this->getPDO();

        $result = [];
        $result["venue"] = [$name];

        $stmt = $pdo->prepare($this->addvenue);

        $stmt->execute($result["venue"]);

        $vid = $pdo->lastInsertId();

        $result["spaces"] = [];

        $stmt = $pdo->prepare($this->addspace);
        foreach ($spaces as $spacename){

            $values = [$vid,$spacename];
            $stmt->execute($values);
            $id = $pdo->lastInsertId();
            array_unshift($values,$id);
            $result["spaces"][] = $values;
        }
        return $result;
    }
    public function bookEvent($name,$start,$duration,$space_id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare($this->bookevent);
        $stmt->execute([$name,$start,$duration,$space_id]);
    }
}
