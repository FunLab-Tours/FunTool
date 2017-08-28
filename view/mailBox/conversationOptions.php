<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 28/08/2017
 * Time: 11:56
 */

if(isset($_POST['change']) && $_POST['name'] != "") {
    changeConversationName($_GET['conversationOptions'], $_POST['name']);
    header('Location: index.php?page=mailBox&conversationOptions='.$_GET['conversationOptions']);
}

if(isset($_POST['add'])) {
    addUsersToConversation($_GET['conversationOptions'], $_POST['recipient']);
    header('Location: index.php?page=mailBox&conversationOptions='.$_GET['conversationOptions']);
}

if(isset($_POST['delete'])) {
    removeUsersFromConversation($_GET['conversationOptions'], $_POST['checkRecipient']);
    header('Location: index.php?page=mailBox&conversationOptions='.$_GET['conversationOptions']);
}
?>

<a href="index.php?page=mailBox&conversation=<?=$_GET['conversationOptions']?>"><?=$lang['backToConversation']?></a>

<form action="" method="POST">
    <input name="name" value="<?=getConversation($_GET['conversationOptions'])['name']?>" />
    <input type="submit" name="change" value="<?=$lang['changeName']?>" />
</form>

<form action="" method="POST">
    <select multiple name ="recipient[]">
        <option value="" disabled><?=$lang['recipient']?></option>
        <?php foreach(allUser() as $user) {
            if ($user['idUser'] != $_COOKIE['id'] and !in_array($user, getUsersInConversation($_GET['conversationOptions']))) { ?>
                <option value="<?= $user['idUser'] ?>"><?= $user['login'] ?></option>
            <?php }
        } ?>
    </select>
    <input type="submit" name="add" value="<?=$lang['addToConversation']?>" />
</form>

<form action="" method="POST">
    <?php foreach (getUsersInConversation($_GET['conversationOptions']) as $user) {
        if($user['idUser'] != $_COOKIE['id']) { ?>
            <input type="checkbox" name="checkRecipient[]" value="<?=$user['idUser']?>"/><?=$user['login']?>
    <?php }
    } ?>
    <input type="submit" name="delete" value="<?=$lang['deleteSelected']?>" />
</form>
