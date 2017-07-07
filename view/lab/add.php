<?php
    include('functions.php');
    include('../../include/db.php');
    include('../../include/config.php');
        
        if(isset($_POST['submit']) && !empty($_POST['submit'])){
            addLab($_POST['labName'],$_POST['labDescription']);
        }

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang["editMachine"]?>" name="labName" />
    <input type="text" placeholder="Lab Description" name="labDescription" />
    <input type="submit" value="submit" name="submit">
</form>
