<?php

    $conversation = getConversation($_GET['conversation']);

    if(isset($_POST['submit']) && $_POST['text'] != "") {
        createMessage($conversation['idConversation'], $_COOKIE['id'], $_POST['text']);
        header('Location: index.php?page=mailBox&conversation='.$conversation['idConversation']);
    }

?>

<!-- Conversation information. -->
<?=$conversation['name']?> |
<?php foreach(getUsersInConversation($conversation['idConversation']) as $user) {
    if ($user['idUser'] != $_COOKIE['id']) { ?>
        <?= $user['login'] ?> ;
    <?php }
}?>

<?php if(countUserInConversation($conversation['idConversation']) != 2) { ?>
    <a href="index.php?page=mailBox&conversationOptions=<?=$conversation['idConversation']?>"><?=$lang['options']?></a>
<?php } ?>

<div></div>

<!-- All the messages. -->
<?php foreach (getMessages($conversation['idConversation']) as $message) { ?>
    ####################<div></div>
    <?=getUser($message['idUser'])['login']?> (<?=$message['sentDateTime']?>) : <div></div>
    <?=$message['textMessage']?><div></div>
<?php } ?>

<!-- Response. -->
<form action="" method="POST">
    <textarea name="text" placeholder=<?=$lang['response']?>></textarea>
    <input type="submit" value="<?=$lang["send"]?>" name="submit">
</form>
