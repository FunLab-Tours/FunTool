<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/09/2017
 * Time: 11:28
 */

$idLab = listAllLab()[0]['idLab'];

if(isset($_POST['submit']) && isset($_POST['material']) && isset($_POST['quantity']))
{
    updateMaterialsQuantity($idLab, $_POST['material'], $_POST['quantity']);
    //header('Location: index.php?page=materials');
}

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['labelMat']?></td>
        <td><?=$lang['codeMat']?></td>
        <td><?=$lang['lastRestock']?></td>
        <td><?=$lang['quantityInStock']?></td>
    </tr>
<?php foreach (listMaterials() as $material) {
    $stock = getMaterialStock($idLab, $material['idMat']);?>
    <tr>
        <td><?=$material['labelMat']?></td>
        <td><?=$material['codeMat']?></td>
        <td><?=$stock['lastRestock']?></td>
        <td><?=$stock['quantityInStock']?> <?=getCostUnitMat($material['idMat'])['unit']?></td>
    </tr>
<?php } ?>
</table>

<form method="POST" action="">
    <select name="material">
        <option value="" disabled selected><?=$lang['chooseMat']?></option>
        <?php foreach (listMaterials() as $material) { ?>
            <option value="<?=$material['idMat']?>"><?=$material['labelMat']?></option>
        <?php } ?>
    </select>
    <input type = "number" placeholder="<?=$lang['quantity']?>" name = "quantity">
    <input type="submit" value="<?=$lang['changeStock']?>" name="submit">
</form>
