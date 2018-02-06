<?php
    if(isset($_POST['submit'])) {
		$isValidSignOnReturn = isValidSignOn(null, null, null, $_POST['firstName'], $_POST['name'], $_POST['telephone'], $_POST['addressL1'], $_POST['zipCode'], $_POST['town'], $_POST['country'], $_POST['email'], $_POST['birthDate']); // TODO : change know use.

		if($isValidSignOnReturn && $isValidSignOnReturn > 0) {
			editUser($_POST['firstName'], $_POST['name'], $_POST['telephone'], $_POST['addressL1'], $_POST['addressL2'], $_POST['addressL3'], $_POST['zipCode'], $_POST['town'], $_POST['country'], $_POST['email'], $_POST['emailBis'], $_POST['birthDate'], $_POST['inscriptionActiveList'], $_POST['inscriptionNews'], $_POST['idPicture']);
			header('Location: index.php?page=profile');
		}
		else
			echo $error[$isValidSignOnReturn];
	}

    $user = getUser($_COOKIE['id']);

?>

<form method="POST" action="">
    <div><?=$lang["login"]?> : <?=$user['login']?></div>
    <div>
        <?php
            $picture = getPicture($user['idPicture']);
        ?>
        <label for="idPicture"> <?=$lang["idPicture"]?> : </label><input id="idPicture" type="url" name="idPicture" value="<?=$picture['picture']?>"/>
    </div>

    <div><label for="firstName"> <?=$lang["firstName"]?> : </label><input id="firstName" type="text" name="firstName" value="<?=$user['firstName']?>"/></div>
    <div><label for="name"> <?=$lang["name"]?> : </label><input id="name" type="text" name="name" value="<?=$user['name']?>"/></div>
    <?php
    if(isMember($user['idUser'])) {
        ?> <div><?=$lang['isMember']?> : <?=$lang['yes']?></div> <?php
    }
    else {
        ?> <div><?=$lang['isMember']?> : <?=$lang['no']?></div> <?php
    }
    ?>
    <div><?=$lang["nbFunnies"]?> : <?=$user['nbFunnies']?></div>
    <div><label for="telephone"> <?=$lang["telephone"]?> : </label><input id="telephone" type="tel" name="telephone" value="<?=$user['telephone']?>"/></div>
    <div><label for="address"> <?=$lang["address"]?> : </label><input id="address" type="text" name="addressL1" value="<?=$user['addressL1']?>"/>
                                <input id="address" type="text" name="addressL2" value="<?=$user['addressL2']?>"/>
                                <input id="address" type="text" name="addressL3" value="<?=$user['addressL3']?>"/>
    </div>
    <div><label for="zipCode"><?=$lang["zipCode"]?> : </label><input id="zipCode" type="number" name="zipCode" value="<?=$user['zipCode']?>"/></div>
    <div><label for="town"><?=$lang["town"]?> : </label><input id="town" type="text" name="town" value="<?=$user['town']?>"/></div>
    <div><label for="country"><?=$lang["country"]?> : </label><input id="country" type="text" name="country" value="<?=$user['country']?>"/></div>
    <div><label for="email"><?=$lang["email"]?> : </label><input id="email" type="email" name="email" value="<?=$user['email']?>"/></div>
    <div><label for="emailBis"><?=$lang["emailBis"]?> : </label><input id="emailBis" type="email" name="emailBis" value="<?=$user['emailBis']?>"/></div>
    <div><label for="birthDate"><?=$lang["birthDate"]?> : </label><input id="birthDate" type="date" name="birthDate" value="<?=$user['birthDate']?>"/></div>

    <div><?=$lang["haveSubscribeActiveList"]?>
        <label for="inscriptionActiveList"><?php if($user['inscriptionActiveList'] == 1) { ?></label>
            <input id="inscriptionActiveList" type="radio" name="inscriptionActiveList" value="true" checked> <?=$lang['yes']?><br>
            <input id="inscriptionActiveList" type="radio" name="inscriptionActiveList" value="false"> <?=$lang['no']?><br>
        <?php } else { ?>
            <input id="inscriptionActiveList" type="radio" name="inscriptionActiveList" value="true"> <?=$lang['yes']?><br>
            <input id="inscriptionActiveList" type="radio" name="inscriptionActiveList" value="false" checked> <?=$lang['no']?><br>
        <?php } ?>
    </div>

    <div><?=$lang["haveSubscribeNews"]?>
		<label for="inscriptionNews"><?php if($user['inscriptionNews'] == 1) { ?></label>
            <input id="inscriptionNews" type="radio" name="inscriptionNews" value="true" checked> <?=$lang['yes']?><br>
            <input id="inscriptionNews" type="radio" name="inscriptionNews" value="false"> <?=$lang['no']?><br>
        <?php } else { ?>
            <input id="inscriptionNews" type="radio" name="inscriptionNews" value="true"> <?=$lang['yes']?><br>
            <input id="inscriptionNews" type="radio" name="inscriptionNews" value="false" checked> <?=$lang['no']?><br>
        <?php } ?>
    </div>

    <input type="submit" value="<?=$lang["submit"]?>" name="submit" />
</form>
