<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/08/2017
 * Time: 16:25
 */

?>


<?php
foreach (listConversations($_COOKIE['id']) as $conversation){ ?>
    <a href="index.php?page=mailBox&conversation=<?=$conversation['idConversation']?>">
        <div>
            <?=$conversation['name']?> |
            <?php foreach(getUsersInConversation($conversation['idConversation']) as $user) {
                if ($user['idUser'] != $_COOKIE['id']) { ?>
                    <?= $user['login'] ?> ;
                <?php }
            }?>
        </div>
    </a>
<?php } ?>