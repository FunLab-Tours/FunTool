<?php

loadModules("user");

if(isset($_POST['submit'])) {
	$isValidSignOnReturn = isValidSignOn($_POST['login'], $_POST['password'], $_POST['passwordChecker'], $_POST['firstName'], $_POST['name'], $_POST['telephone'], $_POST['addressL1'], $_POST['zipCode'], $_POST['town'], $_POST['country'], $_POST['email'], $_POST['birthDate']);

	if($isValidSignOnReturn && $isValidSignOnReturn > 0) {
		addUser($_POST['login'], $_POST['password'], $_POST['firstName'], $_POST['name'], $_POST['telephone'], $_POST['addressL1'], $_POST['addressL2'], $_POST['addressL3'], $_POST['zipCode'], $_POST['town'], $_POST['country'], $_POST['email'], $_POST['emailBis'], $_POST['birthDate'], $_POST['inscriptionActiveList'], $_POST['inscriptionNews'], "");
		connectUser($_POST['login']);
		header('Location: index.php');
	}
	else
		echo $error[$isValidSignOnReturn];
}

?>

<form method="POST" action="" enctype="multipart/form-data">
	<input type="text" placeholder="<?=$lang["login"]?>" name="login"/>
	<input type="password" placeholder="<?=$lang["password"]?>" name="password"/>
	<input type="password" placeholder="<?=$lang["passwordChecker"]?>" name="passwordChecker"/>
	<input type="file" placeholder="<?=$lang["idPicture"]?>" name="idPicture"/>
	<input type="text" placeholder="<?=$lang["firstName"]?>" name="firstName"/>
	<input type="text" placeholder="<?=$lang["name"]?>" name="name"/>
	<input type="tel" placeholder="<?=$lang["telephone"]?>" name="telephone"/>
	<input type="text" placeholder="<?=$lang["addressL1"]?>" name="addressL1"/>
	<input type="text" placeholder="<?=$lang["addressL2"]?>" name="addressL2"/>
	<input type="text" placeholder="<?=$lang["addressL3"]?>" name="addressL3"/>
	<input type="number" placeholder="<?=$lang["zipCode"]?>" name="zipCode"/>
	<input type="text" placeholder="<?=$lang["town"]?>" name="town"/>
	<input type="text" placeholder="<?=$lang["country"]?>" name="country"/>
	<input type="text" placeholder="<?=$lang["email"]?>" name="email"/>
	<input type="text" placeholder="<?=$lang["emailBis"]?>" name="emailBis"/>
	<input type="date" placeholder="<?=$lang["birthDate"]?>" name="birthDate"/>
	<!-- inscriptionActiveList -->
	<label for="inscriptionActiveList"> <?=$lang["inscriptionActiveList"]?> </label>
	<input type="radio" id="inscriptionActiveList" name="inscriptionActiveList" value="true" checked/> <?=$lang["yes"]?>
	<input type="radio" id="inscriptionActiveList" name="inscriptionActiveList" value="false"/> <?=$lang["no"]?>
	<!-- inscriptionNews -->
	<label for="inscriptionNews"> <?=$lang["inscriptionNews"]?> </label>
	<input type="radio" id="inscriptionNews" name="inscriptionNews" value="true" checked/> <?=$lang["yes"]?>
	<input type="radio" id="inscriptionNews" name="inscriptionNews" value="false"/> <?=$lang["no"]?>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit"/>
</form>
