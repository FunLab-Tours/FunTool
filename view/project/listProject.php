    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["projectTitle"]?></td>
        <td><?=$lang["projectWiki"]?></td>
        <td><?=$lang["dateProject"]?></td>
        <td><?=$lang["projectCategory"]?></td>
        <td><?=$lang["participants"]?></td>
    </tr>

    <?php
        
        foreach(listAllProject() as $row){
?>
            <tr>
                <td><a href="index.php?page=project&idInfo=<?=$row[idProject]?>"><?=$row['title']?></a></td>
                <td><?=$row['wiki']?></td>
                <td><?=date("d/m/Y", strtotime($row['dateProject']))?></td>
                <td><?=selectSpecificProjectCategory(selectProjectInIsIncludeIn($row['idProject'])['idProCat'])['title']?></td>
                <td><?=selectUser(selectParticipantsToProject($row['idProject'])['idUser'])['login']?></td>
                <td><a href="index.php?page=project&idEdit=<?=$row['idProject']?>" \><?=$lang["edit"]?></a> | <a href="index.php?page=project&idDelete=<?=$row['idProject']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
            </tr>
<?php
        }

    ?>
    </table>