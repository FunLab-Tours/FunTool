<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["startdateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statutEvent"]?></td>
        <td><?=$lang["ticketsLeft"]?></td>
        <td><?=$lang["pricePlace"]?></td>
        <td><?=$lang["subscription"]?></td>
    </tr>

    <?php
        
        foreach(listAllEvent() as $row){
            $ticketsLeft = ticketsLeft($row['nbPlaces'],$row['idEvent']);
            echo "<tr>";
            echo "<td><a href=\"index.php?page=event&idInfo=$row[idEvent]\">".$row['shortSumEvent']."</a></td>";
            echo "<td>".$row['startdateEvent']."</td>";
            echo "<td>".$row['endDatEvent']."</td>";
            echo "<td>".labelSelectBox($row['statutEvent'])."</td>";
            echo "<td>".$ticketsLeft."/".$row['nbPlaces']."</td>";
            echo "<td>".$row['pricePlace']."</td>";
            echo "<td>".showSubButton($ticketsLeft,$row['idEvent'])."</td>";
            //echo $_COOKIE["id"];
        }
    ?>
    </table>
</body>
