<?php

    if(isset($_POST['submit'])){
        if(isset($_POST['roleList'])) {
            assignRolesToUser($_GET['editUser'], $_POST['roleList']);
            header('Location: index.php?page=administration&rightsAndRoles&listUser=1');
        }
    }

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['login']?></td>
        <td><?=$lang['firstName']." ".$lang['name']?></td>
        <td><?=$lang['roles']?></td>
        <td><?=$lang['rights']?></td>
    </tr>
    <?php foreach(getUserList() as $row) {
        if ($row['idUser'] == $_GET['editUser']) { ?>
            <tr>
                <form method="POST" action="">
                    <td><?= $row['login'] ?></td>
                    <td><?= $row['firstName'] . " " . $row['name'] ?></td>
                    <td>
                        <select multiple name="roleList[]">
                            <?php foreach (getRolesList() as $role) {
                                if (in_array($role, getUserRoles($row['idUser']))) { ?>
                                    <option selected="selected" value="<?= $role['idRole'] ?>"><?= $role['roleName'] ?></option>
                                <?php }
                                else { ?>
                                    <option value="<?= $role['idRole'] ?>"><?= $role['roleName'] ?></option>
                                <?php }
                            }?>
                        </select>
                    </td>
                    <td></td>
                    <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td>
                </form>
            </tr>
        <?php }
        else { ?>
            <tr>
                <td><?= $row['login'] ?></td>
                <td><?= $row['firstName'] . " " . $row['name'] ?></td>
                <td>
                    <?php foreach (getUserRoles($row['idUser']) as $role) { ?>
                        <?= $role['roleName'] ?> ;
                    <?php } ?>
                </td>
                <td>
					<?php
					$list = getRightsListWithRoles(getUserRoles($row['idUser']));

					foreach($list as $row)
						echo($row['rightsTitle'] . " ; ");
					?>
                </td>
                <td><a href="index.php?page=administration&rightsAndRoles&editUser=<?= $row['idUser'] ?>"><?= $lang['edit'] ?></a></td>
            </tr>
        <?php }
    }?>
</table>
