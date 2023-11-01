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
    $messagesInFile = getContentAsArray($file);

    array_push($messagesInFile, $messageObj);
    $content = json_encode($messagesInFile);

    file_put_contents($file,$content);
}

?>