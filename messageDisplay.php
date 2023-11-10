	<?php 
		function displayMessages($displayMessages) 
		{
			
			for ($i = 0; $i < count($displayMessages); $i++){
				messageDisplay($displayMessages[$i]);
			}
		}

		function messageDisplay($messageObject){
			$replace = ["{name}", "{message}","{id}"];
			$values = [
				$messageObject->getName(), 
				$messageObject->getMessage(), 
				$messageObject->getID()
			];

			$template = file_get_contents("messageDisplay.html");
			echo str_replace($replace, $values, $template);
		}
	?>