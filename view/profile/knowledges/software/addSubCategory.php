<?php

    if(isset($_POST['submit']) && $_POST['code'] != "" && $_POST['label'] != "") {
        addSoftwareSubCategory($_GET['addSubCategory'], $_POST['code'], $_POST['label']);

        header('Location: index.php?page=profile&knowledge&categories=0');
    }

?>

<form action = "" method = "POST">
    <input type="text" value="" placeholder="<?=$lang['subCatCode']?>" name="code">
    <input type="text" value="" placeholder="<?=$lang['subCatLabel']?>" name="label">
    <input type="submit" value="<?=$lang["addSubCat"]?>" name="submit">
</form>