<?php declare(strict_types=1);

$displayMessages = json_decode(getContentFromFile($file));

function getContentFromFile($file){
    if(file_exists($file)){
        return file_get_contents($file,true);
    }
    return createEmptyArrayFile($file);
}
function getContentAsArray($file){
	return json_decode(getContentFromFile($file));
}


	// function displayGuestbook() {
// 	$guestbookEntries = array($name, $message); 
// 	foreach ($guestbookEntries as $entry) {
// 		echo $entry, "\n";

// 	}
// }

?>