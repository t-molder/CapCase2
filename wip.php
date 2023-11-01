<?php
//! This file contains code we want to move into other files, eventually this file should be completely empty and removed

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

//function
if(!(file_exists($file))){
    createEmptyArrayFile($file);
}

$submissionIsValid = false;
if(isset($_POST['submit']))
{
    //validate input
    //note: make validation function for post variables
    $inputValid = (isset($_POST['name']) && !(empty($_POST['name'])) && isset($_POST['message']) && !(empty($_POST['message'])));

    $name = $_POST['name'];
    $message = $_POST['message'];
    $submissionIsValid = true;

    if($inputValid){
        //generate json content for guestbook file
        $messageObj = new Message($name,$message);

        //append new content to file content
        array_push($displayMessages, $messageObj);
        $content = json_encode($displayMessages);
        file_put_contents($file,$content);

    }
}

//function more 
function createEmptyArrayFile($file){
    $content = json_encode([]);
    file_put_contents($file,$content);
}
?>