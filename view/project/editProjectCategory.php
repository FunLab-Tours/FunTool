<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
        updateProjectCategory($_GET['idEditProjectCategory'], $_POST['title'], $_POST['longCategoryLabel']);
        header('Location: index.php?page=project&listProjectCategory=0');
        }
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["title"]?></td>
        <td><?=$lang["longCategoryLabel"]?></td>
    </tr>

<?php
    foreach(listAllProjectCategory() as $row){
        if($row['idProCat'] == $_GET['idEditProjectCategory']){?>

    <tr>
        <form action="" method="POST">
            <td><input type="text" placeholder="<?=$lang["title"]?>" name="title" value="<?=$row['title']?>"/></td>
            <td><input type="text" placeholder="<?=$lang["longCategoryLabel"]?>" name="longCategoryLabel" value="<?=$row['longCategoryLabel']?>" /></td>
            <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td> 
        </form> 
    </tr>

<?php
        }
        else{
?> 
    <tr>
            <td><?=$row['title']?></td>
            <td><?=$row['longCategoryLabel']?></td>
    </tr>
<?php
        }
    }
?>
