<?php declare(strict_types=1);
require '../dev/log-to-console.php'; //! remove this and all logToConsole calls before merging with any other branches!

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

$file = "guestbook.txt";
$content = "";

//function
if(!(file_exists($file))){
    createEmptyArrayFile($file);
}

$displayMessages = json_decode(getContentFromFile($file));

$submissionIsValid = false;
if(isset($_POST['submit']))
{
    logToConsole("run this");
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

    //if all submitted correctly, clear submission by rerouting to index.php
    //header("Location: ".$_SERVER['PHP_SELF']);
    logToConsole("unset post, post is now ".(isset($_POST)));
}

//function
function getContentFromFile($file){
    if(file_exists($file)){
        return file_get_contents($file,true);
    }
    return null;
}

//function more 
function createEmptyArrayFile($file){
    $content = json_encode([]);
    file_put_contents($file,$content);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gastenboek</title>   
</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="index.php" method="POST">
            <div>
                <label for='name' style="display:none;">Naam</label>
                <? logToConsole($name); ?>
                <input type='text' id='name' name='name' placeholder="Naam"
                    value="<?php
                        if($submissionIsValid){
                            echo $name;
                        } else{
                            "";
                        }?>"
                    >
                </input>
            </div>
            <div>
                <label for='message' style="display:none;">Bericht</label>
                <? logToConsole($message); ?>
                <input type='text' id='message' name='message' placeholder='Bericht'
                    value="<?php
                        if($submissionIsValid){
                            echo $message;
                        } else{
                            "";
                        }?>"
                    >
                </input>
            </div>
            <input type="submit" name="submit" value="teken gastboek"></input>
        </form>
        <p>
            <?php
            if($submissionIsValid){
                echo "<div> Submitted: $message - $name </div>";
            }
            
            echo "<div> JSON: $content </div>";
            ?>

            <?php for ($i = 0; $i < count($displayMessages); $i++) : ?>
                <div class="guestbook-entry">
                    <div class="name"><?php echo $displayMessages[$i]->name?></div>
                    <div class="message"><?php echo $displayMessages[$i]->message?></div>
                </div>  
            <?php endfor; ?>
        </p>

        <a href="http://localhost/CapCase2/">Clear Input Data</a>
    </main>
</body>
</html>