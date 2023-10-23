<?php declare(strict_types=1);
require '../dev/log-to-console.php'; //! remove this and all logToConsole calls before merging with any other branches!

class Message{
    public $name;
    public $message;
}

$messageObj = new Message();
$TestMessage = "no message submitted";


$submissionIsValid = false;
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $message = $_POST['message'];
    $submissionIsValid = true;

    $messageObj->name = $name;
    $messageObj->message = $message;

    $content = json_encode($messageObj);

    file_put_contents("test.txt",$message);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gastenboek</title>   
</title>
<!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <main>
        <form action="index.php" method="POST">
            <div>
                <label for='name' style="display:none;">Naam</label>
                <input type='text' name='name' placeholder="Naam"
                    value=<?php
                        if($submissionIsValid){
                            echo $name;
                        } else{
                            "";
                        }?>
                    >
                </input>
            </div>
            <div>
                <label for='message' style="display:none;">Bericht</label>
                <input type='text' name='message' placeholder='Bericht'
                    value=<?php
                        if($submissionIsValid){
                            echo $message;
                        } else{
                            "";
                        }?>
                    >
                </input>
            </div>
            <input type="submit" name="submit" value="teken gastboek"></input>
        </form>
        <p>
            <?php
            if($submissionIsValid){
                echo "<div> Submitted: $message - $name </div>";
                echo "<div> JSON: $content </div>";
            }
            ?>
        </p>

        <a href="http://localhost/CapCase2/">Clear Input Data</a>
    </main>
</body>
</html>