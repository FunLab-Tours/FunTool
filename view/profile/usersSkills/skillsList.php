<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 14:58
 */

if(isset($_POST['submit']) && $_POST['skills'] != "" && $_POST['skillLevel'] > 0) {
    assignSkills($_COOKIE['id'], $_POST['skills'], $_POST['skillLevel'], $_POST['comment']);
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
    <?php foreach(getSkillsListUser($_COOKIE['id']) as $skill){ ?>
        <tr>
            <td><?=$skill['skillName']?></td>
            <td><?=$skill['skillDescription']?></td>
            <td><?=getSkillType($skill['idSkillType'])['skillTypeName']?></td>
            <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['skillLevel']?></td>
            <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['comment']?></td>
            <td><a href="index.php?page=profile&usersSkills=1&editAssignment=<?=$skill['idSkill']?>"><?=$lang['edit']?></a>
                | <a href="index.php?page=profile&usersSkills=1&unassignSkill=<?=$skill['idSkill']?>"><?=$lang['delete']?></a></td>
        </tr>
    <?php } ?>
</table>
<form method = "POST" action = "">
    <select name ="skills">
        <option value="" selected="selected"></option>
        <?php
        foreach(getSkillsList() as $row){?>
            <option value="<?=$row['idSkill']?>"><?=$row['skillName']." | ".$row['skillDescription']." | ".getSkillType($row['idSkillType'])['skillTypeName']?></option>
        <?php } ?>
    </select>
    <input type="number" value=0 placeholder="<?=$lang['skillLevel']?>" name="skillLevel">
    <input type="text" value="" placeholder="<?=$lang['comment']?>" name="comment">
    <input type="submit" value="<?=$lang["assignSkill"]?>" name="submit">
</form>
