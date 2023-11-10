<?php
	$currentPage = 2;
	$messageAmount = 5;

	function displayPage(int $pageIndex, int $messageAmount){
		global $guestbook;
		$startMessage = $pageIndex * $messageAmount - 1;
		$pageContent = $guestbook->getMessagesInRange($startMessage,$messageAmount);

		echo "page content <br>";
		echo var_dump($pageContent);

		displayMessages($pageContent);
	}

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