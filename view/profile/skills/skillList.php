<?php

    if(isset($_POST['submitSkill']) && $_POST['skillName'] != "" && $_POST['idSkillType'] != "") {
        if (addSkill($_POST['skillName'], $_POST['skillDescription'], $_POST['idSkillType']))
        header('Location: index.php?page=profile&skills=1');
    }
    if(isset($_POST['submitSkillType']) && $_POST['skillTypeName'] != "")
        if (addSkillType($_POST['skillTypeName']))
            header('Location: index.php?page=profile&skills=1');

?>

<!-- Skill table. -->
<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillName"]?></td>
        <td><?=$lang["skillDescription"]?></td>
        <td><?=$lang["skillType"]?></td>
    </tr>
    <?php foreach(getSkillsList() as $skill){ ?>
        <tr>
            <td><?=$skill['skillName']?></td>
            <td><?=$skill['skillDescription']?></td>
            <td><?=getSkillType($skill['idSkillType'])['skillTypeName']?>
            </td><td><a href="index.php?page=profile&skills=1&editSkill=<?=$skill['idSkill']?>"><?=$lang['edit']?></a>
                | <a href="index.php?page=profile&skills=1&deleteSkill=<?=$skill['idSkill']?>" onClick="return confirm(<?=$lang["deleteConfirmation"]?>)"><?=$lang['delete']?></a></td>

        </tr>
    <?php } ?>
    <tr>
        <form method = "POST" action = "">
            <td><input type="text" placeholder="<?=$lang['skillName']?>" name="skillName" /></td>
            <td><input type="text" placeholder="<?=$lang['skillDescription']?>" name="skillDescription" /></td>
            <td>
                <select name ="idSkillType"">
                <option value="" selected="selected"><?=$lang['skillType']?></option>
                <?php
                foreach(getSkillsTypeList() as $row){?>
                    <option value="<?=$row['idSkillType']?>"><?=$row['skillTypeName']?></option>
                <?php } ?>
                </select>
            </td>
            <td><input type="submit" value="<?=$lang["addSkill"]?>" name="submitSkill"></td>
        </form>
    </tr>
</table>

<!-- Skill type table. -->
<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillTypeName"]?></td>
    </tr>
    <?php foreach(getSkillsTypeList() as $skillType) { ?>
        <tr>
            <td><?= $skillType['skillTypeName'] ?></td>
            <td>
                <a href="index.php?page=profile&skills=1&editSkillType=<?= $skillType['idSkillType'] ?>"><?= $lang['edit'] ?></a>
                | <a href="index.php?page=profile&skills=1&deleteSkillType=<?= $skillType['idSkillType'] ?>"
                     onClick="return confirm(<?= $lang["deleteConfirmation"] ?>)"><?= $lang['delete'] ?></a></td>
        </tr>
    <?php } ?>
    <form method = "POST" action = "">
        <td><input type="text" placeholder="<?=$lang['skillTypeName']?>" name="skillTypeName" /></td>
        <td><input type="submit" value="<?=$lang["addSkillType"]?>" name="submitSkillType"></td>
    </form>
</table>
