<?php

    if(isset($_POST['submit']) && isset($_POST['labName'])) {
        if(isValidLab($_POST['labName'])) {
            try {
                addLab($_POST['labName'], $_POST['labDescription']);
            }
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
                header('Location: index.php?page=lab');
        }
    }

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang["labNameAddLab"]?>" name="labName" />
    <input type="text" placeholder="<?=$lang["labDescriptionAddLab"]?>" name="labDescription" />
    <input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>

