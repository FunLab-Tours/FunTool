<?php
    loadModules("user");

    if(isset($_POST['submit'])) {
        if(isValidSignOn()) {
            addUser($_POST['login'],
                $_POST['password'],
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
                0, // $_POST['nbFunnies'], TODO : use global parameter.
                $_POST['inscriptionActiveList'],
                $_POST['inscriptionNews'],
                "");
            //connectUser($_POST['login'], $_POST['password']);
            //header('Location: index.php');
        }
    }
?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="text" placeholder="<?=$lang["login"]?>" name="login" />
    <input type="password" placeholder="<?=$lang["password"]?>" name="password" />
    <input type="password" placeholder="<?=$lang["passwordChecker"]?>" name="passwordChecker" />
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
