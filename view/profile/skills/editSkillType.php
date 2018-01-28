<?php

    if(isset($_POST['submit']) && $_POST['skillTypeName'] != "")
        if(editSkillType($_GET['editSkillType'], $_POST['skillTypeName']))
            header('Location: index.php?page=profile&skills=1');

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillTypeName"]?></td>
</tr>
<?php foreach(getSkillsTypeList() as $skillType) {
    if ($skillType['idSkillType'] == $_GET['editSkillType']) { ?>
        <form method="POST" action="">
            <td><input type="text" value="<?= $skillType['skillTypeName'] ?>" name="skillTypeName"/></td>
            <td><input type="submit" value="<?= $lang["edit"] ?>" name="submit"></td>
        </form>
    <?php } else { ?>
        <tr>
            <td><?= $skillType['skillTypeName'] ?></td>
            <td>
                <a href="index.php?page=profile&skills=1&editSkillType=<?= $skillType['idSkillType'] ?>"><?= $lang['edit'] ?></a>
                | <a href="index.php?page=profile&skills=1&deleteSkillType=<?= $skillType['idSkillType'] ?>"
                     onClick="return confirm(<?= $lang["deleteConfirmation"] ?>)"><?= $lang['delete'] ?></a></td>
        </tr>
    <?php }
}?>
</table>