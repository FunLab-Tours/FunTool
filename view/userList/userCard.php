<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2017
 * Time: 15:30
 */

$user = getUser($_GET['details']);
$skills = getSkillsListUser($_GET['details']);
$knowledges = listKnowledges($_GET['details']);

?>

<div><?=$lang["login"]?> : <?=$user['login']?></div>

<?php
if(getPicture($user['idPicture']) != null && getPicture($user['idPicture'])['picture'] != ""){
    ?>
    <div>
        <td><img src = "<?=getPicture($user['idPicture'])['picture']?>" height="400" width="400" alt = "<?=getPicture($user['idPicture'])['pictureDescription']?>"</td>
    </div>
    <?php
}
?>

<div><?=$lang["firstName"]?> : <?=$user['firstName']?></div>
<div><?=$lang["name"]?> : <?=$user['name']?></div>
<div><?=$lang["email"]?> : <?=$user['email']?></div>
<a href="index.php?page=mailBox&send=<?=$user['idUser']?>"><?=$lang['contact']?></a>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["skillName"]?></td>
        <td><?=$lang["skillDescription"]?></td>
        <td><?=$lang["skillType"]?></td>
        <td><?=$lang["skillLevel"]?></td>
        <td><?=$lang["comment"]?></td>
    </tr>
    <?php foreach($skills as $skill){ ?>
        <tr>
            <td><?=$skill['skillName']?></td>
            <td><?=$skill['skillDescription']?></td>
            <td><?=getSkillType($skill['idSkillType'])['skillTypeName']?></td>
            <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['skillLevel']?></td>
            <td><?=getSkillUserInformation($_COOKIE['id'], $skill['idSkill'])['comment']?></td>
        </tr>
    <?php } ?>
</table>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["softwareName"]?></td>
        <td><?=$lang["softwareDescription"]?></td>
        <td><?=$lang["skillLevel"]?></td>
        <td><?=$lang["comment"]?></td>
    </tr>
    <?php foreach($knowledges as $knowledge){
        $software = getSoftWare($knowledge['idSoftware']);?>
        <tr>
            <td><?=$software['softwareName']?></td>
            <td><?=$software['softwareDescription']?></td>
            <td><?=$knowledge['knowledgeLevel']?></td>
            <td><?=$knowledge['comment']?></td>
        </tr>
    <?php } ?>
</table>
