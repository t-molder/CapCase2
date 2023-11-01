<?php declare(strict_types=1);

$file = "guestbook.txt";

include 'message.php';
include 'create.php';
include 'wip.php';
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
        <a href="http://localhost/CapCase2/">Reload & clear Input Data</a>

        <form action="index.php" method="POST">
            <div>
                <label for='name' style="display:none;">Naam</label>
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
            <div>Messages<div>
            <?php for ($i = 0; $i < count($displayMessages); $i++) : ?>
                <div class="guestbook-entry">
                    <div class="name"><?php echo $displayMessages[$i]->name?></div>
                    <div class="message"><?php echo $displayMessages[$i]->message?></div>
                </div>  
            <?php endfor; ?>
        </p>

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