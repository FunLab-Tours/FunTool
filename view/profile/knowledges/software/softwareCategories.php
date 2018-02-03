<?php

    if(isset($_POST['submit']) && $_POST['code'] != "" && $_POST['label'] != "") {
        addSoftwareCategory($_POST['code'], $_POST['label']);
        header('Location: index.php?page=profile&knowledge&categories=0');
    }

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["catCode"]?></td>
        <td><?=$lang["catLabel"]?></td>
    </tr>
    <?php foreach(listSoftwareCategories() as $category){?>
        <tr>
            <td><?=$category['categoryCode']?></td>
            <td><?=$category['categoryLabel']?></td>
            <td>
                <a href="?page=profile&knowledge=1&editCategory=<?=$category['idSoftCat']?>"><?=$lang['edit']?></a>
                | <a href="?page=profile&knowledge&deleteCategory=<?=$category['idSoftCat']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a>
                | <a href="?page=profile&knowledge&addSubCategory=<?=$category['idSoftCat']?>"><?=$lang["addSubCat"]?></a>
            </td>
        </tr>
        <!--Affichage des sous-catégorie de la catégorie sous la catégorie-->
        <?php foreach (listSoftwareSubCategories($category['idSoftCat']) as $sub){ ?>
            <tr>
                <td><?=$sub['SubcatCode']?></td>
                <td><?=$sub['SubcatLabel']?></td>
                <td>
                    <a href="?page=profile&knowledge=1&editSubCategory=<?=$sub['idSoftSubcat']?>"><?=$lang['edit']?></a>
                    | <a href="?page=profile&knowledge=1&deleteSubCategory=<?=$sub['idSoftSubcat']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>

<form action = "" method = "POST">
    <input type="text" value="" placeholder="<?=$lang['catCode']?>" name="code">
    <input type="text" value="" placeholder="<?=$lang['catLabel']?>" name="label">
    <input type="submit" value="<?=$lang["addCat"]?>" name="submit">
</form>