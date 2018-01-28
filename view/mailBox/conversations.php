<?php
foreach (listConversations($_COOKIE['id']) as $conversation){ ?>
    <a href="index.php?page=mailBox&conversation=<?=$conversation['idConversation']?>">
        <div>
            <?php if(countUserInConversation($conversation['idConversation']) > 2) { ?>
                <?=$conversation['name']?> |
            <?php }
            foreach(getUsersInConversation($conversation['idConversation']) as $user) {
                if ($user['idUser'] != $_COOKIE['id']) { ?>
                    <?= $user['login'] ?> ;
                <?php }
            }?>
            (<?=$conversation['startDateTime']?>)
            <?php $count = haveUnreadMessage($conversation['idConversation'], $_COOKIE['id']);
                if($count != 0) { ?>
                    (<?=$count?>)
            <?php } ?>
        </div>
    </a>
<?php } ?>
