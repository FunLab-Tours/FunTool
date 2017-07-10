<?php

    loadModules("lab");

    if(isset($_POST['submit']) && !empty($_POST['submit'])){
        if (isValideLab($_POST['labName'])){
            addLab($_POST['labName'],$_POST['labDescription']);
            header('Location: index.php');
        }
    }

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang["labName"]?>" name="labName" />
    <input type="text" placeholder="<?=$lang["labDescription"]?>" name="labDescription" />
    <input type="submit" value="submit" name="submit">
</form>
