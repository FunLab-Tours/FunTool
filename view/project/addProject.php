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
    <select name="projectCategory">
    <option value=""><?=$lang["None"]?></option>
    <?php
    foreach(selectAllProjectCategory() as $row){
        echo "<option value='".$row['idProCat']."'>".$row['title']."</option>";
    }

    ?> 
    </select>
    : Catégorie Projet
    <br><br>
    <?php
        foreach(selectAllMachine() as $row){
        echo "<option value='".$row['idMachine']."'>".$row['title']."</option>";
    }

    ?> 
    </select>
    : Liste Machine
    <input type="submit" value="<?=$lang["submit"]?>" name="submit"> 
</form> 
