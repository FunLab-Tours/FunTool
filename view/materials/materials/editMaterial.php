<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 11:35
 */

if(isset($_POST['submit']) && $_POST['labelMat'] != "" && $_POST['codeMat'] != "" && isset($_POST['priceMat']) && $_POST['priceMat'] >= 0)
{
    if(editMaterial( $_GET['editMaterial'], $_POST['labelMat'], $_POST['codeMat'], $_POST['priceMat'], $_POST['docLink'], $_POST['comment']))
        ;//header('Location: index.php?page=materials&material=0');
}
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['labelMat']?></td>
        <td><?=$lang['codeMat']?></td>
        <td><?=$lang['priceMat']?></td>
        <td><?=$lang['docLink']?></td>
        <td><?=$lang['comment']?></td>
    </tr>

    <?php foreach (listMaterials() as $material) {
        if ($material['idMat'] == $_GET['editMaterial']) { ?>
            <form action="" method="POST">
            <tr>
                <td>
                    <input value="<?=$material['labelMat']?>" name="labelMat" />
                </td>
                <td>
                    <input value="<?=$material['codeMat']?>" name="codeMat" />
                </td>
                <td>
                    <input type="number" value="<?=$material['priceMat']?>" name="priceMat" />
                </td>
                <td>
                    <input value="<?=$material['docLink']?>" name="docLink" />
                </td>
                <td>
                    <input value="<?=$material['comment']?>" name="comment" />
                </td>
                <td>
                    <input type="submit" value="<?=$lang["submit"]?>" name="submit">
                </td>
            </tr>
            </form>
        <?php } else { ?>
            <tr>
                <td><?= $material['labelMat'] ?></td>
                <td><?= $material['codeMat'] ?></td>
                <td><?= $material['priceMat'] ?></td>
                <td><?= $material['docLink'] ?></td>
                <td><?= $material['comment'] ?></td>
                <td>
                    <a href="index.php?page=materials&&material=0editMaterial=<?= $material['idMat'] ?>"><?= $lang['edit'] ?></a>
                    | <a href="index.php?page=materials&&material=0deleteMaterial=<?= $material['idMat'] ?>"
                         onClick="return confirm('Are you sure you want to delete?')"><?= $lang['delete'] ?></a>
                </td>
            </tr>
        <?php }
    }?>
</table>