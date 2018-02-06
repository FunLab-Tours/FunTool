<?php

$user = getUser($_COOKIE['id']);

?>

<div><?=$lang["login"]?> : <?=$user['login']?></div>
<a href="index.php?page=profile&editPass=1"><?=$lang['editPassword']?></a>

<?php
if(getPicture($user['idPicture']) != null && getPicture($user['idPicture'])['picture'] != "") {
	?>
	<div>
		<img src="<?=getPicture($user['idPicture'])['picture']?>" height="400" width="400"
			 alt="<?=getPicture($user['idPicture'])['pictureDescription']?>"
	</div>
	<?php
}
?>

<div><?=$lang["firstName"]?> : <?=$user['firstName']?></div>
<div><?=$lang["name"]?> : <?=$user['name']?></div>
<?php
if(isMember($user['idUser'])) {
	?>
	<div><?=$lang['isMember']?> : <?=$lang['yes']?></div> <?php
}
else {
	?>
	<div><?=$lang['isMember']?> : <?=$lang['no']?></div> <?php
}
?>
<div><?=$lang["nbFunnies"]?> : <?=$user['nbFunnies']?></div>
<div><?=$lang["telephone"]?> : <?=$user['telephone']?></div>
<div><?=$lang["address"]?> : <?=$user['addressL1'] . " " . $user['addressL2'] . " " . $user['addressL3']?></div>
<div><?=$lang["zipCode"]?> : <?=$user['zipCode']?></div>
<div><?=$lang["town"]?> : <?=$user['town']?></div>
<div><?=$lang["country"]?> : <?=$user['country']?></div>
<div><?=$lang["email"]?> : <?=$user['email']?></div>

<?php
if($user['emailBis'] != null) {
	?>
	<div><?=$lang["emailBis"]?> : <?=$user['emailBis']?></div>
	<?php
}
?>

<div><?=$lang["birthDate"]?> : <?=$user['birthDate']?></div>

<div><?=$lang["haveSubscribeActiveList"]?>
	<label for="inscriptionActiveList"> <?php if($user['inscriptionActiveList'] == 1) { ?> </label>
		<input id="inscriptionActiveList" type="radio" checked disabled> <?=$lang['yes']?><br>
		<input id="inscriptionActiveList" type="radio" disabled> <?=$lang['no']?><br>
	<?php } else { ?>
		<input id="inscriptionActiveList" type="radio" disabled> <?=$lang['yes']?><br>
		<input id="inscriptionActiveList" type="radio" checked disabled> <?=$lang['no']?><br>
	<?php } ?>
</div>

<div><?=$lang["haveSubscribeNews"]?>
	<label for="inscriptionNews"> <?php if($user['inscriptionNews'] == 1) { ?> </label>
		<input id="inscriptionNews" type="radio" checked disabled> <?=$lang['yes']?><br>
		<input id="inscriptionNews" type="radio" disabled> <?=$lang['no']?><br>
	<?php } else { ?>
		<input id="inscriptionNews" type="radio" disabled> <?=$lang['yes']?><br>
		<input id="inscriptionNews" type="radio" checked disabled> <?=$lang['no']?><br>
	<?php } ?>
</div>

<a href="index.php?page=profile&editUser=1"><?=$lang['edit']?></a>
