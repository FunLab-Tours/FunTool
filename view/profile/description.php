<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/08/2017
 * Time: 10:45
 */

$user = getUser($_COOKIE['id']);
?>

<div>
    <?=$lang["login"]?> : <?=$user['login']?>
</div>
<a href="index.php?page=profile&editPass=1?>"><?=$lang['editPassword']?></a>
<?php if(getPicture($user['idPicture']) != null && getPicture($user['idPicture'])['picture'] != ""){ ?>
    <div>
        <td><img src = "<?=getPicture($user['idPicture'])['picture']?>" height="400" width="400" alt = "<?=getPicture($user['idPicture'])['pictureDescription']?>"</td>
    </div>
<?php } ?>
<div>
    <?=$lang["firstName"]?> : <?=$user['firstName']?>
</div>
<div>
    <?=$lang["name"]?> : <?=$user['name']?>
</div>
<div>
    <?=$lang["telephone"]?> : <?=$user['telephone']?>
</div>
<div>
    <?=$lang["adress"]?> : <?=$user['adressL1']." ".$user['adressL2']." ".$user['adressL3']?>
</div>
<div>
    <?=$lang["zipCode"]?> : <?=$user['zipCode']?>
</div>
<div>
    <?=$lang["town"]?> : <?=$user['town']?>
</div>
<div>
    <?=$lang["country"]?> : <?=$user['country']?>
</div>
<div>
    <?=$lang["email"]?> : <?=$user['email']?>
</div>
<?php if($user['emailBis'] != null){ ?>
    <div>
        <?=$lang["emailBis"]?> : <?=$user['emailBis']?>
    </div>
<?php } ?>
<div>
    <?=$lang["birthDate"]?> : <?=$user['birthDate']?>
</div>
<div>
    <?=$lang["haveSubscribeActiveList"]?>
    <?php if($user['inscriptionActiveList'] == 1){?>
        <input type="radio" checked disabled> <?=$lang['yes']?><br>
        <input type="radio" disabled> <?=$lang['no']?><br>
    <?php } else { ?>
        <input type="radio" disabled> <?=$lang['yes']?><br>
        <input type="radio" checked disabled> <?=$lang['no']?><br>
    <?php } ?>
</div>
<div>
    <?=$lang["haveSubscribeNews"]?>
    <?php if($user['inscriptionNews'] == 1){?>
        <input type="radio" checked disabled> <?=$lang['yes']?><br>
        <input type="radio" disabled> <?=$lang['no']?><br>
    <?php } else { ?>
        <input type="radio" disabled> <?=$lang['yes']?><br>
        <input type="radio" checked disabled> <?=$lang['no']?><br>
    <?php } ?>
</div>
<a href="index.php?page=profile&editUser=1?>"><?=$lang['edit']?></a>