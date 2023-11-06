<?php

class Guestbook implements JsonSerializable{
    public $file;
    private $messages;

    function __construct(string $file)
    {
        $this->ensureFileExists($file);
        $this->file = $file;
        $this->messages = $this->getMessagesFromFile();
    }

    function getFile(){
        return $this->file;
    }

    function getMessages(){
        return $this->messages;
    }

    #region create file
    function ensureFileExists(string $file){
        if((file_exists($file))){
            return;
        }
        $this->createFileWithEmptyArray($file);
    }

    function createFileWithEmptyArray($file){
        $content = json_encode([]);
        file_put_contents($file,$content);
    }
    #endregion

    #region add/create
    public function addMessage($messageObj){
        array_push($this->messages, $messageObj);

        $this->saveToFile();
    }
    #endregion

    #region read
    function getMessagesFromFile(){
        return json_decode(file_get_contents($this->file,true));
    }

    function getContentFromFile(){
        return file_get_contents($this->file,true);
    }
    #endregion

    #region update
    function updateMessage($id, $messageObj){

        $this->saveToFile();
    }
    #endregion

    #region delete
    function deleteAllMessages(){
        $this->messages = [];

        $this->saveToFile();
    }
    #endregion

    #region save
    function saveToFile(){ 
        $content = json_encode($this,JSON_PRETTY_PRINT);
    
        file_put_contents($this->file,$content);
    }
    #endregion

    function jsonSerialize(): mixed
    {
        //return $this->getMessages();
        return $this->messages;
    }
}
?>