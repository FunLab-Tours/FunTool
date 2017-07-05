<?php
	if(isset($_POST['login'])){
		var_dump($_POST);
		setcookie("id", "222", time()+30000, "/");
		setcookie("token", sha1("222".$privateKey), time()+30000, "/");
	}

?>

<form method="POST" action="">
	<input type="text" placeholder="login" name="login" />
	<input type="password" placeholder="password" name="password" />
	<input type="submit" value="submit">
</form>
