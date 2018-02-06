<?php

try {
	updateUserFunnies($_COOKIE['id'], $_POST['newBalance']);
}
catch(Exception $e) {
	if($DEBUG_MODE)
		echo $e;
	echo $error[-1];
}

header('Location: index.php?page=funnies');
