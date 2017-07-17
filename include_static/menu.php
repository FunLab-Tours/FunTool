<?php
    if(isset($_POST["disconnect"])) {
        loadModules("user");
        disconnectUser();
        header('Location: index.php');
    }

    if(isset($_COOKIE['id']) && sha1($_COOKIE['id'] . $privateKey) == $_COOKIE['token']){
        ?>
        <a href="?page=profile"><?=$lang["profile"]?></a>
        <a href="?page=membership"><?=$lang["membership"]?></a>
        <a href="?page=funnies"><?=$lang["funnies"]?></a>
        <a href="?page=lab"><?=$lang["lab_management"]?></a>
        <a href="?page=event"><?=$lang["event_management"]?></a>
        <!-- Gestion machines. -->
        <!-- Gestion materiaux. -->
        <form action="" method="post">
            <input type="submit" value="<?=$lang["disconnect"]?>" name="disconnect">
        </form>
        <?php
    }

?>
