<?php

    if(isset($_POST['submit']) && $_POST['code'] != "" && $_POST['label'] != "") {
        editSubCategory($_GET['editSubCategory'], $_POST['code'], $_POST['label']);
        header('Location: index.php?page=profile&knowledge&categories=0');
    }

    $subCat = getSubCategory($_GET['editSubCategory']);

?>

<form action = "" method = "POST">
    <input type="text" value="<?=$subCat['SubcatCode']?>" name="code">
    <input type="text" value="<?=$subCat['SubcatLabel']?>" name="label">
    <input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>