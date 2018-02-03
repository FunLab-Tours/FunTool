<?php

    if(isset($_POST['submit']) && $_POST['skillLevel'] != 0) {
        if(editKnowledge($_COOKIE['id'], $_GET['editKnowledge'], $_POST['skillLevel'], $_POST['comment']))
            header('Location: index.php?page=profile&knowledge=1');
    }

    $software = getSoftWare($_GET['editKnowledge']);

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["softwareName"]?></td>
        <td><?=$lang["softwareDescription"]?></td>
        <td><?=$lang["skillLevel"]?></td>
        <td><?=$lang["comment"]?></td>
    </tr>
    <?php foreach(listKnowledge($_COOKIE['id']) as $knowledge) {
        $software = getSoftWare($knowledge['idSoftware']); ?>
        <tr>
            <td><?= $software['softwareName'] ?></td>
            <td><?= $software['softwareDescription'] ?></td>
            <?php if ($_GET['editKnowledge'] != $knowledge['idSoftware']) { ?>
                <td><?= $knowledge['knowledgeLevel'] ?></td>
                <td><?= $knowledge['comment'] ?></td>
                <td>
                    <a href="?page=profile&knowledge&editKnowledge=<?= $software['idSoftware'] ?>"><?= $lang['edit'] ?></a>
                    | <a href="?page=profile&knowledge&deleteKnowledge=<?= $software['idSoftware'] ?>"
                         onClick="return confirm('Are you sure you want to delete?')"><?= $lang['delete'] ?></a>
                </td>
            <?php } else { ?>
                <form action = "" method = "POST">
                    <td><input type="number" value="<?=$knowledge['knowledgeLevel']?>" name="skillLevel"></td>
                    <td><input type="text" value="<?=$knowledge['comment']?>" placeholder="<?=$lang['comment']?>" name="comment"></td>
                    <td><input type="submit" value="<?=$lang["edit"]?>" name="submit"></td>
                </form>
        <?php } ?>
        </tr>
    <?php } ?>
</table>

