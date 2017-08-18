<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 15:49
 */

if(isset($_POST['submit']) && $_POST['skillLevel'] != 0) {
    editAssignment($_COOKIE['id'], $_GET['editAssignment'], $_POST['skillLevel'], $_POST['comment']);
    header('Location: index.php?page=profile&usersSkills=1');
}
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillName"]?></td>
        <td><?=$lang["skillDescription"]?></td>
        <td><?=$lang["skillType"]?></td>
        <td><?=$lang["skillLevel"]?></td>
        <td><?=$lang["comment"]?></td>
    </tr>
    <?php foreach(getSkillsListUser($_COOKIE['id']) as $skill) { ?>
        <tr>
            <td><?= $skill['skillName'] ?></td>
            <td><?= $skill['skillDescription'] ?></td>
            <td><?= getSkillType($skill['idSkillType'])['skillTypeName'] ?></td>
            <?php if ($skill['idSkill'] == $_GET['editAssignment']) { ?>
                    <form method = "POST" action = "">
                        <td><input type="number" value=<?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['skillLevel']?> name="skillLevel"></td>
                        <td><input type="text" value="<?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['comment'] ?>" name="comment"></td>
                        <td><input type="submit" value="<?=$lang["edit"]?>" name="submit"></td>
                    </form>
                <?php }
                else { ?>
                    <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['skillLevel'] ?></td>
                    <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['comment'] ?></td>
                    <td>
                        <a href="index.php?page=profile&usersSkills=1&editAssignment=<?= $skill['idSkill'] ?>"><?= $lang['edit'] ?></a>
                        | <a
                            href="index.php?page=profile&usersSkills=1&unassignSkill=<?= $skill['idSkill'] ?>"><?= $lang['delete'] ?></a>
                    </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>