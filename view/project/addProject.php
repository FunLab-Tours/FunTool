<?php
// linkToProjectCategory(1,1);
// echo lastInsertProjectId();

    if(isset($_POST['submit'])){
            addProject($_POST['projectTitle'], $_POST['projectWiki'], $_POST['dateProject']);
            linkToProjectCategory($_POST['projectCategory'],lastInsertProjectId());
            addParticipantToProject($_COOKIE["id"],lastInsertProjectId());
                if ($_POST['pictureUrl']!==""){
                    addPictureProject($_POST['pictureUrl'],lastInsertProjectId());
                    
                }
            //header('Location: index.php?page=project');
            
    }

?>

 <form action="" method="POST">
    <input type="text" placeholder="<?=$lang["projectTitle"]?>" name="projectTitle" />
     <br><br>
    <input type="url" placeholder="<?=$lang["projectWiki"]?>" name="projectWiki" />
     <br><br>
    <input type="date" placeholder="<?=$lang["dateProject"]?>" name="dateProject" />
     : <?=$lang["dateProject"]?>
     <br><br>
    <select name="projectCategory">
    <option value=""><?=$lang["None"]?></option>
    <?php
        foreach(selectAllProjectCategory() as $row){
    ?>
        <option value="<?=$row['idProCat']?>"><?=$row['title']?></option>;
    <?php
        }

    ?> 
    </select>
    : Catégorie Projet
    <br><br>
    <select name="machine">
    <option value=""><?=$lang["None"]?></option>
    <?php
        foreach(selectAllMachine() as $row){
    ?>
        <option value="<?=$row['idMachine']?>"><?=$row['shortLabel']?></option>;
    <?php
        }

    ?> 
    </select>
    : Liste Machine
    <br><br>
    <input type="url" placeholder="<?=$lang["pictureUrl"]?>" name="pictureUrl" />
     <br><br>
    <input type="submit" value="<?=$lang["submit"]?>" name="submit"> 
</form> 
