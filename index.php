<?php declare(strict_types=1);

$file = "guestbook.txt";

include "messageSubmission.php";
include 'message.php';
include 'create.php';
include "getContents.php";
include "messageDisplay.php";
// include 'wip.php';
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



