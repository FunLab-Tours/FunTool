<?php

loadModules("user");

if(isset($_POST['submit'])) {
	if(isValidUser($_POST['login'], $_POST['password'])) {
		connectUser($_POST['login']);
		header('Location: index.php');
	}
}

?>

<form method="POST" action="">
	<input type="text" placeholder="<?=$lang["login"]?>" name="login"/>
	<input type="password" placeholder="<?=$lang["password"]?>" name="password"/>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit"/>
</form>

<a href="?page=sign_on"><?=$lang["sign_on"]?></a>
