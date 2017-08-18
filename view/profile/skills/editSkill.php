<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 10:33
 */

if(isset($_POST['submit']) && $_POST['skillName'] != "" && $_POST['idSkillType'] != "") {
    if (editSkill($_GET['editSkill'],
        $_POST['skillName'],
        $_POST['skillDescription'],
        $_POST['idSkillType']
    ))
        header('Location: index.php?page=profile&skills=1');
}
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillName"]?></td>
        <td><?=$lang["skillDescription"]?></td>
        <td><?=$lang["skillType"]?></td>
    </tr>
    <?php foreach(getSkillsList() as $skill) {
        if ($skill['idSkill'] == $_GET['editSkill']) { ?>
            <form method = "POST" action = "">
                <td><input type="text" value="<?=$skill['skillName']?>" name="skillName" /></td>
                <td><input type="text" value="<?=$skill['skillDescription']?>" name="skillDescription" /></td>
                <td>
                    <select name ="idSkillType"">
                    <option value="<?=$skill['idSkillType']?>" selected="selected"><?=getSkillType($skill['idSkillType'])['skillTypeName']?></option>
                    <?php
                    foreach(getSkillsTypeList() as $row) {
                        if ($row['idSkillType'] != $skill['idSkillType']) { ?>
                            <option value="<?= $row['idSkillType'] ?>"><?= $row['skillTypeName'] ?></option>
                        <?php }
                    }?>
                    </select>
                </td>
                <td><input type="submit" value="<?=$lang["edit"]?>" name="submit"></td>
            </form>
        <?php } else { ?>
            <tr>
                <td><?= $skill['skillName'] ?></td>
                <td><?= $skill['skillDescription'] ?></td>
                <td><?= getSkillType($skill['idSkillType'])['skillTypeName'] ?>
                </td>
                <td>
                    <a href="index.php?page=profile&skills=1&editSkill=<?= $skill['idSkill'] ?>"><?= $lang['edit'] ?></a>
                    | <a href="index.php?page=profile&skills=1&deleteSkill=<?= $skill['idSkill'] ?>"
                         onClick="return confirm(<?= $lang["deleteConfirmation"] ?>)"><?= $lang['delete'] ?></a></td>

            </tr>
        <?php }
    }?>
</table>