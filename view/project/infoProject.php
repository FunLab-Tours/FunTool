<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["projectTitle"]?></td>
        <td><?=$lang["projectWiki"]?></td>
        <td><?=$lang["dateProject"]?></td>
        <td><?=$lang["pictureProject"]?></td>
    </tr>

    <?php
        foreach(selectProject($_GET['idInfo']) as $row){
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['wiki']."</td>";
            echo "<td>".date("d/m/Y", strtotime($row['dateProject']))."</td>";
            echo "<td><img src=\"".selectProjectPicture($_GET['idInfo'])."\" alt=\"".$row['title']."\"></td>";
            echo "<td><a href=\"index.php?page=project&idEdit=$row[idProject]\">".$lang["edit"]."</a> | <a href=\"index.php?page=project&idDelete=$row[idProject]\" onClick=\"return confirm('Are you sure you want to delete?')\">".$lang["delete"]."</a></td>";
 
        }
    ?>
    </table>
</body>