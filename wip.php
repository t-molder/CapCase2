<?php
//! This file contains code we want to move into other files, eventually this file should be completely empty and removed

//function
if(!(file_exists($file))){
    createFileWithEmptyArray($file);
}

$submissionIsValid = false;
if(isset($_POST['submitNewMessage']))
{
    //validate input
    //note: make validation function for post variables
    $inputValid = (isset($_POST['name']) && !(empty($_POST['name'])) && isset($_POST['message']) && !(empty($_POST['message'])));

    $name = $_POST['name'];
    $message = $_POST['message'];
    $submissionIsValid = true;

    if($inputValid){
        $messageObj = new Message($name,$message);
        saveMessageToFile($file, $messageObj);
    }
}

$content = getContentFromFile($file);
?>