<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["startdateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statutEvent"]?></td>
        <td><?=$lang["nbPlaces"]?></td>
        <td><?=$lang["pricePlace"]?></td>
    </tr>

    <?php
        foreach(listAllEvent() as $row){
            echo "<tr>";
            echo "<td><a href=\"index.php?page=event&idEvent=$row[idEvent]\">".$row['shortSumEvent']."</a></td>";
            echo "<td>".$row['startdateEvent']."</td>";
            echo "<td>".$row['endDatEvent']."</td>";
            echo "<td>".$row['statutEvent']."</td>";
            echo "<td>".$row['nbPlaces']."</td>";
            echo "<td>".$row['pricePlace']."</td>";
            
        }
    ?>
    </table>
</body>
