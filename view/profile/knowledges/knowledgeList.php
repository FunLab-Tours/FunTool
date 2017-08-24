<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 14:35
 */

if(isset($_POST['submit']) && $_POST['skillLevel'] != 0 && isset($_POST['software'])) {
    if(assignKnowledges($_COOKIE['id'], $_POST['software'], $_POST['skillLevel'], $_POST['comment']))
        header('Location: index.php?page=profile&knowledge=1');
}
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["softwareName"]?></td>
        <td><?=$lang["softwareDescription"]?></td>
        <td><?=$lang["skillLevel"]?></td>
        <td><?=$lang["comment"]?></td>
    </tr>
    <?php foreach(listKnowledges($_COOKIE['id']) as $knowledge){
        $software = getSoftWare($knowledge['idSoftware']);?>
        <tr>
            <td><?=$software['softwareName']?></td>
            <td><?=$software['softwareDescription']?></td>
            <td><?=$knowledge['knowledgeLevel']?></td>
            <td><?=$knowledge['comment']?></td>
            <td>
                <a href="?page=profile&knowledge&editKnowledge=<?= $software['idSoftware'] ?>"><?= $lang['edit'] ?></a>
                | <a href="?page=profile&knowledge&deleteKnowledge=<?= $software['idSoftware'] ?>"
                     onClick="return confirm('Are you sure you want to delete?')"><?= $lang['delete'] ?></a>
            </td>
        </tr>
    <?php } ?>
</table>

<form action = "" method = "POST">
    <select name ="software">
        <option value="" selected="selected" ><?= $lang['softwares'] ?></option>
        <?php
        foreach(ListSoftWare() as $row) {
            if (!in_array($row['idSoftware'], listIdSoftwareFromKnowledge($_COOKIE['id']))) { ?>
                <option value="<?= $row['idSoftware'] ?>"><?=$row['softwareName']?> - <?=$row['softwareDescription']?></option>
            <?php }
        }?>
    </select>
    <?=$lang['skillLevel']?>:<input type="number" value=0 name="skillLevel">
    <input type="text" value="" placeholder="<?=$lang['comment']?>" name="comment">
    <input type="submit" value="<?=$lang["assignSkill"]?>" name="submit">
</form>