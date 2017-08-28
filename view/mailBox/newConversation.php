<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/08/2017
 * Time: 16:59
 */

if(isset($_POST['submit']) && $_POST['name'] != "" && $_POST['text'] != "")
{
    $id = createConversation($_POST['recipient'], $_POST['name']);
    createMessage($id, $_COOKIE['id'], $_POST['text']);
    header('Location: index.php?page=mailBox&conversation='.$id);
}
?>

<form action="" method="POST">
    <select multiple name ="recipient[]">
        <option value="" selected="selected"><?=$lang['recipient']?></option>
        <?php foreach(allUser() as $user) {
            if ($user['idUser'] != $_COOKIE['id']) { ?>
                <option value="<?= $user['idUser'] ?>"><?= $user['login'] ?></option>
            <?php }
        } ?>
    </select>
    <input type="text" placeholder="<?=$lang['object']?>" name="name" />
    <textarea name="text" placeholder=<?=$lang['message']?>></textarea>
    <input type="submit" value="<?=$lang["send"]?>" name="submit">
</form>