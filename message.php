<?php
include_once 'guidv4.php';
class Message implements JsonSerializable{
    public $name;
    public $message;
    public $id;

    function __construct(string $name, string $message, string $id = null)
    {
        $this->name = $name;
        $this->message = $message;
        $this->id = $id ?? $this->generateID();
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

#region helper functions
function isValidAsMessage($object){
    return (property_exists($object, 'name') && 
            property_exists($object, 'message'));
}

function createMessageFrom($object){
    $messageID = $object->id ?? null;

    return new Message($object->name,$object->message,$messageID);
}
#endregion
?>