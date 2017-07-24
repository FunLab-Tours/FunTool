<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["longSumEvent"]?></td>
        <td><?=$lang["startdateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statutEvent"]?></td>
        <td><?=$lang["ticketsLeft"]?></td>
        <td><?=$lang["pricePlace"]?></td>
        <td><?=$lang["subscription"]?></td>

    </tr>

    <?php
        foreach(selectEvent($_GET['idInfo']) as $row){
            $ticketsLeft = ticketsLeft($row['nbPlaces'],$row['idEvent']);
            echo "<td>".$row['shortSumEvent']."</td>";
            echo "<td>".$row['longSumEvent']."</td>";
            echo "<td>".$row['startdateEvent']."</td>";
            echo "<td>".$row['endDatEvent']."</td>";
            echo "<td>".labelSelectBox($row['statutEvent'])."</td>";
            echo "<td>".$ticketsLeft."/".$row['nbPlaces']."</td>";
            echo "<td>".$row['pricePlace']."</td>";
            echo "<td>".showSubButton($ticketsLeft,$row['idEvent'])."</td>";
            echo "<td><a href=\"index.php?page=event&idEdit=$row[idEvent]\">Edit</a> | <a href=\"index.php?page=event&idDelete=$row[idEvent]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
    ?>
    </table>
</body>
