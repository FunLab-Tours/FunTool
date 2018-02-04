<?php
    $randomPassword = random_password(8);
    $passwordChecked = $randomPassword;

    if(isset($_POST['submit'])) {
		$isValidSignOnReturn = isValidSignOn();

		if($isValidSignOnReturn && $isValidSignOnReturn > 0) {
            try {
                addUser($_POST['login'],
                    $passwordChecked,
                    $_POST['firstName'],
                    $_POST['name'],
                    $_POST['telephone'],
                    $_POST['adressL1'],
                    $_POST['adressL2'],
                    $_POST['adressL3'],
                    $_POST['zipCode'],
                    $_POST['town'],
                    $_POST['country'],
                    $_POST['email'],
                    $_POST['emailBis'],
                    $_POST['birthDate'],
                    $_POST['inscriptionActiveList'],
                    $_POST['inscriptionNews'],
                    "");
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
        else
			echo $error[$isValidSignOnReturn];
	}

?>

<form method="POST" action="" enctype="multipart/form-data">
<input type="text" placeholder="<?=$lang["login"]?>" name="login" />
<input type="file" placeholder="<?=$lang["idPicture"]?>" name="idPicture" />
<input type="text" placeholder="<?=$lang["firstName"]?>" name="firstName" />
<input type="text" placeholder="<?=$lang["name"]?>" name="name" />
<input type="tel" placeholder="<?=$lang["telephone"]?>" name="telephone" />
<input type="text" placeholder="<?=$lang["adressL1"]?>" name="adressL1" />
<input type="text" placeholder="<?=$lang["adressL2"]?>" name="adressL2" />
<input type="text" placeholder="<?=$lang["adressL3"]?>" name="adressL3" />
<input type="number" placeholder="<?=$lang["zipCode"]?>" name="zipCode" />
<input type="text" placeholder="<?=$lang["town"]?>" name="town" />
<input type="text" placeholder="<?=$lang["country"]?>" name="country" />
<input type="text" placeholder="<?=$lang["email"]?>" name="email" />
<input type="text" placeholder="<?=$lang["emailBis"]?>" name="emailBis" />
<input type="date" placeholder="<?=$lang["birthDate"]?>" name="birthDate">
<!-- inscriptionActiveList -->
<?=$lang["inscriptionActiveList"]?>
<input type="radio" name="inscriptionActiveList" value="true" checked> <?=$lang["yes"]?>
<input type="radio" name="inscriptionActiveList" value="false"> <?=$lang["no"]?>
<!-- inscriptionNews -->
<?=$lang["inscriptionNews"]?>
<input type="radio" name="inscriptionNews" value="true" checked> <?=$lang["yes"]?>
<input type="radio" name="inscriptionNews" value="false"> <?=$lang["no"]?>
<input type="submit" value="<?=$lang["submit"]?>" name="submit" />
</form>


