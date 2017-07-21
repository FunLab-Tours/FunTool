<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
       updateEvent($_GET['idEdit'], $_POST['shortSumEvent'], $_POST['longSumEvent'], $_POST['startdateEvent'], $_POST['endDatEvent'], $_POST['statutEvent'], $_POST['nbPlaces'], $_POST['pricePlace']);
       header('Location: index.php?page=event');
    }
?>

<body>
    <table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["shortSumEvent"]?></td>
        <td><?=$lang["longSumEvent"]?></td>
        <td><?=$lang["startdateEvent"]?></td>
        <td><?=$lang["endDatEvent"]?></td>
        <td><?=$lang["statutEvent"]?></td>
        <td><?=$lang["nbPlaces"]?></td>
        <td><?=$lang["pricePlace"]?></td>
    </tr>

        <?php
            foreach(selectEvent($_GET['idEdit']) as $row) { ?>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" name="shortSumEvent" value ="<?=$row['shortSumEvent']?>" /></td>
                        <td><textarea rows="5" cols="50" name="longSumEvent"><?=$row['longSumEvent']?></textarea></td>
                        <td><input type="datetime-local" value="<?= str_replace(" ","T",$row['startdateEvent']);?>"  name="startdateEvent" /></td>
                        <td><input type="datetime-local" value="<?=str_replace(" ","T",$row['endDatEvent']);?>" name="endDatEvent" /></td>
                        <td><select name="statutEvent">
                            <option selected=<?=$row['statutEvent']?>>
                            <?=labelSelectBox($row['statutEvent'])?></option>
                            <?=editLabelSelectBox($row['statutEvent'])?>
                            <!-- <option value="ok"><?=$lang["statutOk"]?></option>
                            <option value="maybe"><?=$lang["statutMaybe"]?></option>
                            <option value="cancel"><?=$lang["statutCancel"]?></option> -->
                        </select></td>
                        <td><input type="number" value="<?=$row['nbPlaces']?>" name="nbPlaces" /></td>
                        <td><input type="number" value="<?=$row['pricePlace']?>" name="pricePlace" /></td>
                        <td><input type="submit" value="submit" name="submit"><a href="index.php?page=lab">Cancel</a></td>
                    </form>
                </tr>
                <?php
            }
        ?>

    </table>
</body>