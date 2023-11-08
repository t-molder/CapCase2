<?php

class Guestbook implements JsonSerializable{
    public $file;
    private $messages;

    function __construct(string $file)
    {
        $this->ensureFileExists($file);
        $this->file = $file;
        $this->messages = $this->getMessagesFromFile();

        $this->saveToFile();
    }

    function getFile(){
        return $this->file;
    }

    function getMessages(){
        return $this->messages;
    }

    function getMessagesInRange($amount, $start){

        $messages = [...$this->messages];
        array_splice($this->messages, $start, $amount);

        return $this->messages;
    }

    function getMessageByID(string $id){
        $index = $this->getMessageIndex($id);
        if($index == null){
            return null;
        }
        return $this->messages[$index];
    }

    function getMessageIndex(string $id){
        for ($i = 0; $i < count($this->messages); $i++) { 
            $message = $this->messages[$i];
            if($id === $message->id){
                return $i;
            }
        }
        return null;
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
    function getObjectsFromFile(){
        return json_decode(file_get_contents($this->file,true));
    }

    function getMessagesFromFile(){
        $objects = $this->getObjectsFromFile();
        $messages = [];
        foreach($objects as $object){
            if(isValidAsMessage($object)){
                array_push($messages, createMessageFrom($object));
            }
        }
        return $messages;
    }
    #endregion

    #region update
    function editMessage(string $id, $messageObj){
        $index = $this->getMessageIndex($id);
        if($index == null){
            return;
        }

        $message = $this->messages[$index];
        $messageObj->id = $message->id ?? null;
        $this->messages[$index] = $messageObj;

        $this->saveToFile();
    }
    #endregion

    #region delete
    function deleteMessage(string $id) {
        $index = $this->getMessageIndex($id);
        if($index === null){
            return;
        }

        array_splice($this->messages, $index, 1);
        echo "Deleted message at $index";
        $this->saveToFile();
    }

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
        return $this->getMessages();
    }
}
?>