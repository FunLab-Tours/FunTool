<?php

    if(isset($_POST['submit']) && $_POST['labelMat'] != "" && $_POST['codeMat'] != "" && isset($_POST['priceMat']) && $_POST['priceMat'] >= 0) {
        if(addMaterial($_POST['labelMat'], $_POST['codeMat'], $_POST['priceMat'], $_POST['docLink'], $_POST['comment']))
            header('Location: index.php?page=materials&material=0');
    }

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['labelMat']?></td>
        <td><?=$lang['codeMat']?></td>
        <td><?=$lang['priceMat']?></td>
        <td><?=$lang['docLink']?></td>
        <td><?=$lang['comment']?></td>
        <td><?=$lang['dateEntry']?></td>
    </tr>

    <?php foreach (listMaterials() as $material) { ?>
        <tr>
            <td><?=$material['labelMat']?></td>
            <td><?=$material['codeMat']?></td>
            <td><?=$material['priceMat']?></td>
            <td><?=$material['docLink']?></td>
            <td><?=$material['comment']?></td>
            <td><?=$material['dateEntry']?></td>
            <td>
                <a href="index.php?page=materials&material=0&editMaterial=<?=$material['idMat']?>"><?=$lang['edit']?></a>
                | <a href="index.php?page=materials&material=0&deleteMaterial=<?=$material['idMat']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a>
            </td>
        </tr>
    <?php } ?>

    <form action="" method="POST">
        <tr>
            <td>
                <input placeholder="<?=$lang['labelMat']?>" name="labelMat" />
            </td>
            <td>
                <input placeholder="<?=$lang['codeMat']?>" name="codeMat" />
            </td>
            <td>
                <input type="number" placeholder="<?=$lang['priceMat']?>" name="priceMat" />
            </td>
            <td>
                <input placeholder="<?=$lang['docLink']?>" name="docLink" />
            </td>
            <td>
                <input placeholder="<?=$lang['comment']?>" name="comment" />
            </td>
            <td>
                <input type="submit" value="<?=$lang["submit"]?>" name="submit">
            </td>
        </tr>
    </form>
</table>