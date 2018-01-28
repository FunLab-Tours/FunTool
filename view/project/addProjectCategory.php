<?php
    if(isset($_POST['submit'])) {
        try {
            addProjectCategory($_POST['title'], $_POST['longCategoryLabel']);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        header('Location: index.php?page=project&listProjectCategory=0');

    }

?>


<form action="" method="POST">
    <input type="text" placeholder="<?=$lang["title"]?>" name="title" />
    <br><br> 
    <input type="text" placeholder="<?=$lang["longCategoryLabel"]?>" name="longCategoryLabel" />
    <br><br>
    <input type="submit" value="<?=$lang["submit"]?>" name="submit"> 
    
</form> 