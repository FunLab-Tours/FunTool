<?php
    if(isset($_POST['submit'])) {
        editUser(
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
            $_POST['idPicture']);
       header('Location: index.php?page=profile');
    }

    $user = getUser($_COOKIE['id']);
?>

<form method="POST" action="">
    <div><?=$lang["login"]?> : <?=$user['login']?></div>
    <div>
        <?php
            $picture = getPicture($user['idPicture']);
        ?>
        <?=$lang["idPicture"]?> : <input type="url" name="idPicture" value="<?=$picture['picture']?>"/>
    </div>

    <div><?=$lang["firstName"]?> : <input type="text" name="firstName" value="<?=$user['firstName']?>"/></div>
    <div><?=$lang["name"]?> : <input type="text" name="name" value="<?=$user['name']?>"/></div>
    <?php
    if(isMember($user['idUser'])) {
        ?> <div><?=$lang['isMember']?> : <?=$lang['yes']?></div> <?php
    }
    else {
        ?> <div><?=$lang['isMember']?> : <?=$lang['no']?></div> <?php
    }
    ?>
    <div><?=$lang["nbFunnies"]?> : <?=$user['nbFunnies']?></div>
    <div><?=$lang["telephone"]?> : <input type="tel" name="telephone" value="<?=$user['telephone']?>"/></div>
    <div><?=$lang["adress"]?> :  <input type="text" name="adressL1" value="<?=$user['adressL1']?>"/>
                                <input type="text" name="adressL2" value="<?=$user['adressL2']?>"/>
                                <input type="text" name="adressL3" value="<?=$user['adressL3']?>"/>
    </div>
    <div><?=$lang["zipCode"]?> : <input type="number" name="zipCode" value="<?=$user['zipCode']?>"/></div>
    <div><?=$lang["town"]?> : <input type="text" name="town" value="<?=$user['town']?>"/></div>
    <div><?=$lang["country"]?> : <input type="text" name="country" value="<?=$user['country']?>"/></div>
    <div><?=$lang["email"]?> : <input type="email" name="email" value="<?=$user['email']?>"/></div>
    <div><?=$lang["emailBis"]?> : <input type="email" name="emailBis" value="<?=$user['emailBis']?>"/></div>
    <div><?=$lang["birthDate"]?> : <input type="date" name="birthDate" value="<?=$user['birthDate']?>"/></div>

    <div><?=$lang["haveSubscribeActiveList"]?>
        <?php if($user['inscriptionActiveList'] == 1) { ?>
            <input type="radio" name="inscriptionActiveList" value="true" checked> <?=$lang['yes']?><br>
            <input type="radio" name="inscriptionActiveList" value="false"> <?=$lang['no']?><br>
        <?php } else { ?>
            <input type="radio" name="inscriptionActiveList" value="true"> <?=$lang['yes']?><br>
            <input type="radio" name="inscriptionActiveList" value="false" checked> <?=$lang['no']?><br>
        <?php } ?>
    </div>

    <div><?=$lang["haveSubscribeNews"]?>
        <?php if($user['inscriptionNews'] == 1) { ?>
            <input type="radio" name="inscriptionNews" value="true" checked> <?=$lang['yes']?><br>
            <input type="radio" name="inscriptionNews" value="false"> <?=$lang['no']?><br>
        <?php } else { ?>
            <input type="radio" name="inscriptionNews" value="true"> <?=$lang['yes']?><br>
            <input type="radio" name="inscriptionNews" value="false" checked> <?=$lang['no']?><br>
        <?php } ?>
    </div>

    <input type="submit" value="<?=$lang["submit"]?>" name="submit" />
</form>
