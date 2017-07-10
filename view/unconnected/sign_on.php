<form method="POST" action="">
    <input type="text" placeholder="<?=$lang["login"]?>" name="login" />
    <input type="text" placeholder="<?=$lang["password"]?>" name="password" />
    <input type="text" placeholder="<?=$lang["firstName"]?>" name="firstName" />
    <input type="text" placeholder="<?=$lang["name"]?>" name="name" />
    <input type="text" placeholder="<?=$lang["telephone"]?>" name="telephone" />
    <input type="text" placeholder="<?=$lang["adressL1"]?>" name="adressL1" />
    <input type="text" placeholder="<?=$lang["adressL2"]?>" name="adressL2" />
    <input type="text" placeholder="<?=$lang["adressL3"]?>" name="adressL3" />
    <input type="text" placeholder="<?=$lang["zipCode"]?>" name="zipCode" />
    <input type="text" placeholder="<?=$lang["town"]?>" name="town" />
    <input type="text" placeholder="<?=$lang["country"]?>" name="country" />
    <input type="text" placeholder="<?=$lang["email"]?>" name="email" />
    <input type="text" placeholder="<?=$lang["emailBis"]?>" name="emailBis" />
    <input type="date" placeholder="<?=$lang["birthDate"]?>" name="birthDate">
    <!-- inscriptionActiveList -->
    <form>
        <?=$lang["inscriptionActiveList"]?>
        <input type="radio" name="inscriptionActiveList" value="true" checked> <?=$lang["yes"]?>
        <input type="radio" name="inscriptionActiveList" value="false"> <?=$lang["no"]?>
    </form>
    <!-- inscriptionNews -->
    <form>
        <?=$lang["inscriptionNews"]?>
        <input type="radio" name="inscriptionNews" value="true" checked> <?=$lang["yes"]?>
        <input type="radio" name="inscriptionNews" value="false"> <?=$lang["no"]?>
    </form>
    <!-- idPicture -->
    <input type="submit" value="<?=$lang["submit"]?>" name="submit" />
</form>
