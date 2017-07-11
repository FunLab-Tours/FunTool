<?php
    include("addLab.php");
?>


<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["labName"]?></td>
        <td><?=$lang["labDescription"]?></td>
    </tr>
     <?php     
        foreach (listAllLab() as $row ) {         
        echo "<tr>";
        echo "<td>".$row['labName']."</td>";
        echo "<td>".$row['labDescription']."</td>";    
        //echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
    }
    ?>
    </table>
</body>
