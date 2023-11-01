<?php
class Message implements JsonSerializable{
    public $name;
    public $message;

    function __construct(string $name,$message)
    {
        $this->name = $name;
        $this->message = $message;
    }

    function jsonSerialize(): mixed
    {
        return $this;
    }
}
?>