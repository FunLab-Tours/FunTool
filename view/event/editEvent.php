<?php

    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
        try {
             updateEvent($_GET['idEdit'], $_POST['shortSumEvent'], $_POST['longSumEvent'], $_POST['startDateEvent'], $_POST['endDatEvent'], $_POST['statusEvent'], $_POST['nbPlaces'], $_POST['pricePlace']);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        header('Location: index.php?page=event');
    }

?>
<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["longSumEvent"]?></td>
        <td><?=$lang["startDateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statusEvent"]?></td>
        <td><?=$lang["nbPlaces"]?></td>
        <td><?=$lang["pricePlace"]?></td>
    </tr>

<?php

    foreach(selectEvent($_GET['idEdit']) as $row){  ?>
        <tr>
            <form action="" method="post">
                <td><input type="text" placeholder="<?=$lang["shortSumEvent"]?>" name="shortSumEvent" value ="<?=$row['shortSumEvent']?>" /></td>
                <td><textarea rows="5" cols="50" placeholder="<?=$lang["longSumEvent"]?>" name="longSumEvent"><?=$row['longSumEvent']?></textarea></td>
                <td><input type="datetime-local" value="<?= str_replace(" ","T",$row['startDateEvent']);?>"  name="startDateEvent" /></td>
                <td><input type="datetime-local" value="<?=str_replace(" ","T",$row['endDatEvent']);?>" name="endDatEvent" /></td>
                <td><select name="statusEvent">
                        <?=editLabelSelectBox($row['statusEvent'])?>
                        <option value="<?=$row['statusEvent']?>" selected><?=labelSelectBox($row['statusEvent'])?></option>
                    </select></td>
                <td><input type="number" placeholder="<?=$lang["nbPlaces"]?>" value="<?=$row['nbPlaces']?>" name="nbPlaces" /></td>
                <td><input type="number" placeholder="<?=$lang["pricePlace"]?>" value="<?=$row['pricePlace']?>" name="pricePlace" /></td>
                <td><input type="submit" value=<?=$lang["submit"]?> name="submit"><a href="index.php?page=event"><?=$lang["cancel"]?></a></td>
            </form>
        </tr>
<?php 
    }
?>

    </table>
</body>