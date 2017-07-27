<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["startdateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statutEvent"]?></td>
        <td><?=$lang["ticketsLeft"]?></td>
        <td><?=$lang["pricePlace"]?></td>
        <td><?=$lang["register"]?></td>
    </tr>

    <?php
        
        foreach(listAllEvent() as $row){
            $ticketsLeft = ticketsLeft($row['nbPlaces'],$row['idEvent']);
            echo "<tr>";
            echo "<td><a href=\"index.php?page=event&idInfo=$row[idEvent]\">".$row['shortSumEvent']."</a></td>";
            echo "<td>".$row['startdateEvent']."</td>";
            echo "<td>".$row['endDatEvent']."</td>";
            echo "<td>".labelSelectBox($row['statutEvent'])."</td>";
            echo "<td>".$ticketsLeft."</td>";
            echo "<td>".$row['pricePlace']."</td>";
            echo "<td>".showRegisterButton($ticketsLeft,$row['idEvent'],alreadyRegistered($row['idEvent'],$_COOKIE["id"]))."</td>";
            
        }
    ?>
    </table>
</body>
