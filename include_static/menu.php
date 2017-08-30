<?php
    loadModules("mailBox/conversation");
    // loadModules("event");
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
        <a href="?page=machine"><?=$lang["machine"]?></a>
        <a href="?page=materials"><?=$lang["materials"]?></a>
        <a href="?page=project"><?=$lang["project_management"]?></a>
        <a href="?page=administration"><?=$lang["administration"]?></a>
        <a href="?page=userList"><?=$lang["userList"]?></a>
        <a href="?page=mailbox">
            <?=$lang["mailBox"]?>
            <?php $count = allUnreadMessages($_COOKIE['id']);
            if($count != 0) { ?>
                (<?=$count?>)
            <?php } ?>
        </a>
        <form action="" method="post">
            <input type="submit" value="<?=$lang["disconnect"]?>" name="disconnect">
        </form>
        <?php
    }
?>
