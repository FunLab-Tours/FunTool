<?php

if(isset($_POST['submit'])) {
	if(strlen($_POST['newPassword']) >= 8 && (strcmp($_POST['newPassword'], $_POST['passwordChecker']) == 0)) {
		if(editPassword($_POST['password'], $_POST['newPassword']) == true) {
			header('Location: index.php?page=profile');
			connectUser(getUser($_COOKIE['id'])['login']);
		}
		else
			echo $lang["passDontMatch"] . " (code 1).";
	}
	else
		echo $lang["passDontMatch"] . " (code 2).";
}

?>

<form method="POST" action="">
	<div><input type="password" name="password" placeholder="<?=$lang["password"]?>" value=""/></div>
	<div><input type="password" name="newPassword" placeholder="<?=$lang["newPassword"]?>" value=""/></div>
	<div><input type="password" name="passwordChecker" placeholder="<?=$lang["passwordChecker"]?>" value=""/></div>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit"/>
</form>
