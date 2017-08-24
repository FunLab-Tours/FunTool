<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2017
 * Time: 15:10
 */
?>


<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['login']?></td>
        <td><?=$lang['picture']?></td>
        <td><?=$lang['firstName']?></td>
        <td><?=$lang['name']?></td>
        <td><?=$lang['email']?></td>
        <td><?=$lang['roles']?></td>
        <td><?=$lang['skills']?></td>
        <td><?=$lang['knowledges']?></td>
    </tr>
    <?php foreach(allUser() as $user){ ?>
        <tr>
            <td><?=$user['login']?></td>
            <?php if(getPicture($user['idPicture']) != null && getPicture($user['idPicture'])['picture'] != ""){ ?>
                <td><img src = "<?=getPicture($user['idPicture'])['picture']?>" height="42" width="42" alt = "<?=getPicture($user['idPicture'])['pictureDescription']?>"</td>
            <?php }
            else { ?>
                <td></td>
            <?php }?>
            <td><?=$user['firstName']?></td>
            <td><?=$user['name']?></td>
            <td><?=$user['email']?></td>
            <td>
                <?php foreach (getUserRoles($user['idUser']) as $role) {
                    echo $role['roleName']." ; ";
                } ?>
            </td>
            <td>
                <?php foreach (getSkillsListUser($user['idUser']) as $skill) {
                    echo $skill['skillName']." ; ";
                } ?>
            </td>
            <td>
                <?php
                foreach (listKnowledges($user['idUser']) as $knowledge) {
                    echo getSoftWare($knowledge['idSoftware'])['softwareName']." ; ";
                } ?>
            </td>
            <td>
                <a href="index.php?page=mailBox&send=<?=$user['idUser']?>"><?=$lang['contact']?></a> |
                <a href="index.php?page=userList&details=<?=$user['idUser']?>"><?=$lang['moreDetails']?></a>
            </td>
        </tr>
    <?php } ?>
</table>
