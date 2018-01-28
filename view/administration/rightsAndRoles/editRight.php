<?php

    if(isset($_POST['submit']) && $_POST['rightsTitle'] != "" && $_POST['rightsPath'] != "") {
        if(editRight( $_GET['editRight'],
            $_POST['rightsTitle'],
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
    foreach(getRightsList() as $row) {
        if($row['idRights'] == $_GET['editRight']){?>
            <tr>
                <form method = "POST" action = "">
                    <td><input type="text" value="<?=$row['rightsTitle']?>" name="rightsTitle" /></td>
                    <td><input type="text" value="<?=$row['rightsDescription']?>" name="rightsDescription" /></td>
                    <td><input type="text" value="<?=$row['rightsPath']?>" name="rightsPath" /></td>
                    <td><input type="submit" value="<?=$lang["editRight"]?>" name="submit"></td>
                </form>
            </tr>
        <?php }
        else { ?>
        <tr>
            <td><?=$row['rightsTitle']?></td>
            <td><?=$row['rightsDescription']?></td>
            <td><?=$row['rightsPath']?></td>
            <td><a href="index.php?page=administration&rightsAndRoles&editRight=<?=$row['idRights']?>"><?=$lang['edit']?></a>
                | <a href="index.php?page=administration&rightsAndRoles&deleteRight=<?=$row['idRights']?>" onClick="return confirm(<?=$lang["deleteConfirmation"]?>)"><?=$lang['delete']?></a></td>
        </tr>
    <?php }
    }?>
</table>
