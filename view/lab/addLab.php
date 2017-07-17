<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
        if(isValideLab($_POST['labName'])) {
            addLab($_POST['labName'], $_POST['labDescription']);
            header('Location: index.php?page=lab');
        }
    }

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang["labNameAddLab"]?>" name="labName" />
    <input type="text" placeholder="<?=$lang["labDescriptionAddLab"]?>" name="labDescription" />
    <input type="submit" value="submit" name="submit">
</form>
