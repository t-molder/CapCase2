<?php
include_once 'guidv4.php';
class Message implements JsonSerializable{
    public $name;
    public $message;
    public $id;

    function __construct(string $name, string $message, string $ID = null)
    {
        $this->name = $name;
        $this->message = $message;
        $this->id = $ID ?? $this->generateID();
    }

    public function getName(){
        return $this->name;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getID(){
        return $this->id;
    }

    function generateID(){
        return guidv4();
    }

    function jsonSerialize(): mixed
    {
        return $this;
    }
}
?>