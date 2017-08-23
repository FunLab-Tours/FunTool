<table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["frameName"]?></td>
        <td><?=$lang["framePrice"]?></td>
        <td><?=$lang["bonusMembership"]?></td>
        <td><?=$lang["entryDate"]?></td>
    </tr>

    <?php
        foreach(listAllMembershipFrame() as $row){
            echo "<tr>";
            echo "<td>".$row['frameName']."</td>";
            echo "<td>".$row['framePrice']."</td>";
            echo "<td>".$row['bonusMembership']."</td>";
            echo "<td>".$row['entryDate']."</td>";
            echo "<td><a href=\"index.php?page=membership&idFrameEdit=$row[idMembershipFrame]\">".$lang["edit"]."</a> | <a href=\"index.php?page=membership&idFrameDelete=$row[idMembershipFrame]\" onClick=\"return confirm('Are you sure you want to delete?')\">".$lang["delete"]."</a></td>";
        }
    ?>
    </table>