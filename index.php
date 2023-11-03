<?php declare(strict_types=1);

$file = "guestbook.txt";

include 'message.php';
include 'guestbook.php';

$guestbook = new Guestbook($file);

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

        $guestbook->addMessage($messageObj);

    }
}

$content = $guestbook->getContentFromFile();
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
    <?php messageSubmission(); ?>
    <a href="http://localhost/CapCase2/">Reload & clear Input Data</a>
        <p>
            <?php
            if($submissionIsValid){
                echo "<div> Submitted: $message - $name </div>";
            }

            //this displays the Json content of the #file for debugging purposes and should eventually be removed
            echo "<div> JSON: $content </div>";
            ?>
        </p>
    </main>
</body>
</html>



