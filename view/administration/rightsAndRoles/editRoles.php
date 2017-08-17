<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/08/2017
 * Time: 14:25
 */
if(isset($_POST['submit']) && isset($_POST['roleName'])){
    if(isset($_POST['rightsList']))
        editRole( $_GET['editRole'],
            $_POST['roleName'],
            $_POST['roleDescription'],
            $_POST['rightsList']
        );
    else
        editRole( $_GET['editRole'],
        $_POST['roleName'],
        $_POST['roleDescription'],
        null
    );
   header('Location: index.php?page=administration&rightsAndRoles&listRoles=1');
}
?>

<table width='80%' border=0>

    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["roleName"]?></td>
        <td><?=$lang["roleDescription"]?></td>
        <td><?=$lang["rightsList"]?></td>
    </tr>

    <?php
    foreach(getRolesList() as $row) {
        if ($row['idRole'] == $_GET['editRole']) {
            ?>
            <tr>
                <form method="POST" action="">
                    <td><input type="text" value="<?= $row['roleName'] ?>" name="roleName"/></td>
                    <td><input type="text" value="<?= $row['roleDescription'] ?>" name="roleDescription"/></td>
                    <td>
                        <select multiple name="rightsList[]">
                            <?php foreach (getRightsList() as $right) {
                                if(in_array($right, getRightsRoleList($row['idRole']))) {?>
                                    <option selected="selected" value="<?=$right['idRights']?>"><?= $right['rightsTitle'] ?></option>
                                <?php }
                                else { ?>
                                    <option value="<?=$right['idRights']?>"><?= $right['rightsTitle'] ?></option>
                                <?php }
                            } ?>
                        </select>
                    </td>
                    <td><input type="submit" value="<?=$lang["editRight"]?>" name="submit"></td>
                </form>
            </tr>
        <?php }
        else { ?>
            <tr>
                <td><?= $row['roleName'] ?></td>
                <td><?= $row['roleDescription'] ?></td>
                <td>
                    <select multiple name="rightsList[]">
                        <?php foreach (getRightsRoleList($row['idRole']) as $right) { ?>
                            <option disabled value=""><?= $right['rightsTitle'] ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><a href="index.php?page=administration&rightsAndRoles&editRole=<?= $row['idRole'] ?>"><?= $lang['edit'] ?></a>
                    | <a href="index.php?page=administration&rightsAndRoles&deleteRole=<?= $row['idRole'] ?>"
                         onClick="return confirm(<?= $lang["deleteConfirmation"] ?>)"><?= $lang['delete'] ?></a></td>
                </td>
            </tr>
        <?php }
    }?>
</table>