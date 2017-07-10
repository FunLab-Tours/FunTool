<?php
    include('../../module/lab.php');
    include('../../include/db.php');
    include('../../include/config.php');
        
        if(isset($_POST['submit']) && !empty($_POST['submit'])){
            addLab($_POST['labName'],$_POST['labDescription']);
        }

?>

<form action="" method="post">
    <input type="text" placeholder="<?=$lang["labName"]?>" name="labName" />
    <input type="text" placeholder="<?=$lang["labDescription"]?>" name="labDescription" />
    <input type="submit" value="submit" name="submit">
</form>
