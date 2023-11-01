<?php

function ensureFileExists(string $file){
    if((file_exists($file))){
        return;
    }
    createFileWithEmptyArray($file);
}

function createFileWithEmptyArray($file){
    $content = json_encode([]);
    file_put_contents($file,$content);
}

function saveMessageToFile($file, $messageObj){ 
    $messagesInFile = json_decode(getContentFromFile($file));
    //! update line above to this line
    // $messagesInFile = getContentFromFile($file);

    //append new content to file content
    array_push($messagesInFile, $messageObj);
    $content = json_encode($messagesInFile);
    file_put_contents($file,$content);
}

?>