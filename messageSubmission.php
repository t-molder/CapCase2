<?php 
    function messageSubmission(){
        $replace = ["{name}", "{message}"];
        $values = ["", ""];
        if (isset($_POST["submitNewMessage"]))
        {
            $values = [$_POST["name"], $_POST["message"]]; 
        }
        $template = file_get_contents("form.html");
        echo str_replace($replace, $values, $template);
    }
?>