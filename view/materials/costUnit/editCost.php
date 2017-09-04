<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 14:45
 */

if(isset($_POST['submit']) && isset($_POST['priceUnit']) && isset($_POST['unit']))
{
    assignCostUnit($_GET['edit'], $_POST['priceUnit'], $_POST['unit']);
    header('Location: index.php?page=materials&costUnit=1');
}
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['labelMat']?></td>
        <td><?=$lang['docLink']?></td>
        <td><?=$lang['comment']?></td>
        <td><?=$lang['priceUnit']?></td>
        <td><?=$lang['unit']?></td>
    </tr>

    <?php foreach (listMaterials() as $material) { ?>
        <tr>
            <td><?=$material['labelMat']?></td>
            <td><?=$material['docLink']?></td>
            <td><?=$material['comment']?></td>
            <?php if($material['idMat'] == $_GET['edit']){ ?>
                <form action="" method = "POST">
                    <td><input type="number" name="priceUnit" value="<?=getCostUnitMat($material['idMat'])['costUnit']?>"/></td>
                    <td><input type="text" name="unit" value="<?=getCostUnitMat($material['idMat'])['unit']?>"/></td>
                    <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td>
                </form>
            <?php }
            else{ ?>
                <td><?=getCostUnitMat($material['idMat'])['costUnit']?></td>
                <td><?=getCostUnitMat($material['idMat'])['unit']?></td>
                <td>
                    <a href="index.php?page=materials&costUnit=0&edit=<?=$material['idMat']?>"><?=$lang['edit']?></a>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
