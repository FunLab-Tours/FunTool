<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["projectTitle"]?></td>
        <td><?=$lang["projectWiki"]?></td>
        <td><?=$lang["dateProject"]?></td>
        <td><?=$lang["participate"]?></td>
        <td><?=$lang["participants"]?></td>
    </tr>

    <?php
        
        foreach(listAllProject() as $row){
            echo "<tr>";
            echo "<td><a href=\"index.php?page=project&idInfo=$row[idProject]\">".$row['title']."</a></td>";
            echo "<td>".$row['wiki']."</td>";
            echo "<td>".date("d/m/Y", strtotime($row['dateProject']))."</td>";
            echo "<td><a href=\"index.php?page=project&idEdit=$row[idProject]\">".$lang["edit"]."</a> | <a href=\"index.php?page=project&idDelete=$row[idProject]\" onClick=\"return confirm('Are you sure you want to delete?')\">".$lang["delete"]."</a></td>";
        }
        
    ?>
    </table>
</body>