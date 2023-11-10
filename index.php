<?php declare(strict_types=1);

$file = "guestbook.txt";

include 'message.php';
include 'guestbook.php';

$guestbook = new Guestbook($file);

if (isset($_POST["submitDeleteMessage"]))
{
    $messageID = $_POST["submitDeleteMessage"];
    // echo $messageID;
    // echo $guestbook->getMessageIndex($messageID);
    $guestbook->deleteMessage($messageID);
}

// echo $guestbook->getMessageIndex("891a07e2-31d4-4b93-a82f-79356b4a7090");
function validateName($name)        {return validateText($name);}
function validateMessage($message)  {return validateText($message);}
function validateText($text)
{
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}


$submissionIsValid = false;
if(isset($_POST['submitNewMessage']))
{
    //validate input
    //note: make validation function for post variables

    $inputValid = (isset($_POST['name']) && !(empty($_POST['name'])) && isset($_POST['message']) && !(empty($_POST['message'])));

    $name = validateName($_POST['name']);
    $message = validateMessage($_POST['message']);

    $submissionIsValid = true;

    if($inputValid){
        $messageObj = new Message($name,$message);

        $guestbook->addMessage($messageObj);
    }
}

$content = file_get_contents($guestbook->file,true);
$displayMessages = $guestbook->getMessages();

include 'messageSubmission.php';
include 'messageDisplay.php';
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
        <h1>Gastenboek</h1>
    <?php messageSubmission(); ?>
    <a href="http://localhost/CapCase2/">Reload & clear Input Data</a>
        <p>
            <?php
            displayMessages($displayMessages);
            if($submissionIsValid){
                echo "<div> Submitted: $message - $name </div>";
            }

            //this displays the Json content of the #file for debugging purposes and should eventually be removed
            // echo "<div> JSON: $content </div>";
            ?>
        </p>
    </main>
</body>
</html>



