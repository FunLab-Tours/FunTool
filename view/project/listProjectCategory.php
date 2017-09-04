<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["title"]?></td>
        <td><?=$lang["longCategoryLabel"]?></td>
    </tr>

<?php
    foreach(listAllProjectCategory()as$row){

?>
    <tr>
        <td><?=$row['title']?></td>
        <td><?=$row['longCategoryLabel']?></td>
        <td><a href="index.php?page=project&idEditProjectCategory=<?=$row['idProCat']?>" \><?=$lang["edit"]?></a> | <a href="index.php?page=project&idDeleteProjectCategory=<?=$row['idProCat']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
    </tr>

<?php
    }
?>
</table>