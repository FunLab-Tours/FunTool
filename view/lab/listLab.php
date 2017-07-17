<!-- TODO : remove HTML. -->

<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["labName"]?></td>
        <td><?=$lang["labDescription"]?></td>
    </tr>

    <?php
        foreach(listAllLab() as $row){
            echo "<tr>";
            echo "<td>".$row['labName']."</td>";
            echo "<td>".$row['labDescription']."</td>";
            echo "<td><a href=\"index.php?page=lab&idEdit=$row[idLab]\">Edit</a> | <a href=\"index.php?page=lab&idDelete=$row[idLab]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
    ?>
    </table>
</body>
