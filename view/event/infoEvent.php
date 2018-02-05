<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["longSumEvent"]?></td>
        <td><?=$lang["startDateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statusEvent"]?></td>
        <td><?=$lang["ticketsLeft"]?></td>
        <td><?=$lang["pricePlace"]?></td>
        <td><?=$lang["register"]?></td>

    </tr>

    <?php
        foreach(selectEvent($_GET['idInfo']) as $row){
            $ticketsLeft = ticketsLeft($row['nbPlaces'],$row['idEvent']);
            echo "<td>".$row['shortSumEvent']."</td>";
            echo "<td>".$row['longSumEvent']."</td>";
            echo "<td>".$row['startDateEvent']."</td>";
            echo "<td>".$row['endDatEvent']."</td>";
            echo "<td>".labelSelectBox($row['statusEvent'])."</td>";
            echo "<td>".$ticketsLeft."</td>";
            echo "<td>".$row['pricePlace']."</td>";
            echo "<td>".showRegisterButton($ticketsLeft,$row['idEvent'],alreadyRegistered($row['idEvent'],$_COOKIE["id"]))."</td>";
            echo "<td><a href=\"index.php?page=event&idEdit=$row[idEvent]\">".$lang["edit"]."</a> | <a href=\"index.php?page=event&idDelete=$row[idEvent]\" onClick=\"return confirm('Are you sure you want to delete?')\">".$lang["delete"]."</a></td>";
        }
    ?>
    </table>
</body>
