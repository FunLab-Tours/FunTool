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
        <td><?=$lang["register"]?></td>
        <td><?=$lang["participants"]?></td>
    </tr>

    <?php
        foreach(listAllEvent() as $row) {
            $ticketsLeft = ticketsLeft($row['nbPlaces'], $row['idEvent']);
    ?>
            <tr>
                <!--<td><a href="index.php?page=event&idInfo=$row[idEvent]"><?//=$row['shortSumEvent']?></a></td>-->
                <td><?=$row['shortSumEvent']?></td>
                <td><?=$row['longSumEvent']?></td>
                <td><?=$row['startdateEvent']?></td>
                <td><?=$row['endDatEvent']?></td>
                <td><?=labelSelectBox($row['statutEvent'])?></td>
                <td><?=$ticketsLeft?></td>
                <td><?=$row['pricePlace']?></td>
                <td><?=showRegisterButton($ticketsLeft,$row['idEvent'],alreadyRegistered($row['idEvent'],$_COOKIE["id"]))?></td>
                <td>
                    <?php foreach(nameOfUsersInEvent($row['idEvent']) as $subrow) {
                        ?><?=$subrow['firstName']?> <?=$subrow['telephone']?><br><br><?php
                    }?>
                </td>
                <!--<td><?//=selectAllUsersInEvent($row['idEvent'])?></td>-->
                <td><a href="index.php?page=event&idEdit=<?=$row['idEvent']?>" \><?=$lang["edit"]?></a> | <a href="index.php?page=event&idDelete=<?=$row['idEvent']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
            <tr>
    <?php
        }
    ?>
    </table>
</body>
