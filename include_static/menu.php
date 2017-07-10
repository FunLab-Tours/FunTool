<?php

    if(isset($_COOKIE['id']) && sha1($_COOKIE['id'] . $privateKey) == $_COOKIE['token']){
        ?>
        <a href="?page=profile"><?=$lang["profile"]?></a>
        <a href="?page=membership"><?=$lang["membership"]?></a>
        <a href="?page=funnies"><?=$lang["funnies"]?></a>
        <!-- Gestion machines. -->
        <!-- Gestion materiaux. -->
        <?php
    }

?>
