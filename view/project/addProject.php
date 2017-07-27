<?php
    if(isset($_POST['submit'])){
            addProject($_POST['projectTitle'], $_POST['projectWiki'], $_POST['dateProject']);
            header('Location: index.php?page=project');
        }

?>

 <form action="" method="POST">
    <input type="text" placeholder="<?=$lang["projectTitle"]?>" name="projectTitle" />
     <br><br>
    <input type="text" placeholder="<?=$lang["projectWiki"]?>" name="projectWiki" />
     <br><br>
    <input type="date" placeholder="<?=$lang["dateProject"]?>" name="dateProject" />
     : <?=$lang["dateProject"]?>
     <br><br>
    <input type="submit" value="<?=$lang["submit"]?>" name="submit"> 
</form> 
