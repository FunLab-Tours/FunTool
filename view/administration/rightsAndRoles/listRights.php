<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/08/2017
 * Time: 14:25
 */
if(isset($_POST['submit']) && $_POST['rightsTitle'] != "" && $_POST['rightsPath'] != "") {
    if(addRight( $_POST['rightsTitle'],
        $_POST['rightsDescription'],
        $_POST['rightsPath']
    ))
        header('Location: index.php?page=administration&rightsAndRoles&listRights=1');
}
?>

<table width='80%' border=0>

    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["rightsTitle"]?></td>
        <td><?=$lang["rightsDescription"]?></td>
        <td><?=$lang["rightsPath"]?></td>
    </tr>

    <?php
    foreach(getRightsList() as $row) { ?>
        <tr>
            <td><?=$row['rightsTitle']?></td>
            <td><?=$row['rightsDescription']?></td>
            <td><?=$row['rightsPath']?></td>
            <td><a href="index.php?page=administration&rightsAndRoles&editRight=<?=$row['idRights']?>"><?=$lang['edit']?></a>
                | <a href="index.php?page=administration&rightsAndRoles&deleteRight=<?=$row['idRights']?>" onClick="return confirm(<?=$lang["deleteConfirmation"]?>)"><?=$lang['delete']?></a></td>
        </tr>
    <?php }?>
    <tr>
        <form method = "POST" action = "">
            <td><input type="text" placeholder="<?=$lang['rightsTitle']?>" name="rightsTitle" /></td>
            <td><input type="text" placeholder="<?=$lang['rightsDescription']?>" name="rightsDescription" /></td>
            <td><input type="text" placeholder="<?=$lang['rightsPath']?>" name="rightsPath" /></td>
            <td><input type="submit" value="<?=$lang["addRight"]?>" name="submit"></td>
        </form>
    </tr>
</table>