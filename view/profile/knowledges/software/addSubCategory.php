<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 11:45
 */

if(isset($_POST['submit']) && $_POST['code'] != "" && $_POST['label'] != "") {
    addSubCategory($_GET['addSubCategory'],
        $_POST['code'],
        $_POST['label']
    );
    header('Location: index.php?page=profile&knowledge&categories=0');
}
?>

<form action = "" method = "POST">
    <input type="text" value="" placeholder="<?=$lang['subCatCode']?>" name="code">
    <input type="text" value="" placeholder="<?=$lang['subCatLabel']?>" name="label">
    <input type="submit" value="<?=$lang["addSubCat"]?>" name="submit">
</form>