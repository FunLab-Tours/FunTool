<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["projectTitle"]?></td>
        <td><?=$lang["projectWiki"]?></td>
        <td><?=$lang["dateProject"]?></td>
    </tr>

    <?php
        
        foreach(listAllProject() as $row){
            echo "<tr>";
            echo "<td><a href=\"index.php?page=project&idInfo=$row[idProject]\">".$row['title']."</a></td>";
            echo "<td>".$row['wiki']."</td>";
            echo "<td>".date("d/m/Y", strtotime($row['dateProject']))."</td>";
        }
        
    ?>
    </table>
</body>