<?php

    if(isset($_POST['submit']) && $_POST['code'] != "" && $_POST['label'] != "") {
        editSoftwareCategory($_GET['editCategory'], $_POST['code'], $_POST['label']);
        header('Location: index.php?page=profile&knowledge=0&categories=0');
    }

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["catCode"]?></td>
        <td><?=$lang["catLabel"]?></td>
    </tr>
    <?php foreach(listSoftwareCategories() as $category) {
        if ($_GET['editCategory'] == $category['idSoftCat']) {?>
            <tr>
                <form method = "POST" action="">
                    <td><input type="text" value="<?= $category['categoryCode'] ?>" name="code"/></td>
                    <td><input type="text" value="<?= $category['categoryLabel'] ?>" name="label"/></td>
                    <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td>
                </form>
            </tr>
        <?php } else { ?>
            <tr>
                <td><?= $category['categoryCode'] ?></td>
                <td><?= $category['categoryLabel'] ?></td>
                <td>
                    <a href="?page=profile&knowledge=1&editCategory=<?= $category['idSoftCat'] ?>"><?= $lang['edit'] ?></a>
                    | <a href="?page=profile&knowledge&deleteCategory=<?= $category['idSoftCat'] ?>"
                         onClick="return confirm('Are you sure you want to delete?')"><?= $lang['delete'] ?></a>
                </td>
            </tr>
        <?php }
    }?>
    <tr>
        <form action = "" method = "POST">
            <td><input type="text" value="" placeholder="<?=$lang['catCode']?>" name="code"></td>
            <td><input type="text" value="" placeholder="<?=$lang['catLabel']?>" name="label"></td>
            <td><input type="submit" value="<?=$lang["addCat"]?>" name="submit"></td>
        </form>
    </tr>
</table>