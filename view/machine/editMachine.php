<?php
    if(isset($_POST['submit'])) {
        if(isValidMachineSubmit()) {
            var_dump($_POST['idSubFamily']);
            if(isset($_POST['idSubFamily']))
                editMachine($_GET['idEdit'],
                    $_POST['codeMachine'],
                    $_POST['shortLabel'],
                    $_POST['longLabel'],
                    $_POST['serialNumber'],
                    $_POST['manufacturer'],
                    $_POST['comment'],
                    $_POST['docLink1'],
                    $_POST['docLink2'],
                    $_POST['idFamily'],
                    $_POST['idsSubFamily'],
                    $_POST['cost'],
                    $_POST['costCoeff'],
                    $_POST['idLab']
                );
            else editMachine($_GET['idEdit'],
                    $_POST['codeMachine'],
                    $_POST['shortLabel'],
                    $_POST['longLabel'],
                    $_POST['serialNumber'],
                    $_POST['manufacturer'],
                    $_POST['comment'],
                    $_POST['docLink1'],
                    $_POST['docLink2'],
                    $_POST['idFamily'],
                    null,
                    $_POST['cost'],
                    $_POST['costCoeff'],
                    $_POST['idLab']
                );
            //header('Location: index.php?page=machine');
        }
    }
?>

<table width='80%' border=0>

    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["codeMachineInput"]?></td>
        <td><?=$lang["machineShortLabel"]?></td>
        <td><?=$lang["machineLongLabel"]?></td>
        <td><?=$lang["machineSerialNumber"]?></td>
        <td><?=$lang["machineManufacturer"]?></td>
        <td><?=$lang["machineComment"]?></td>
        <td><?=$lang["machineDocLink1"]?></td>
        <td><?=$lang["machineDocLink2"]?></td>
        <td><?=$lang["machineFamily"]?></td>
        <td><?=$lang["machineSubFamily"]?></td>
        <td><?=$lang["cost"]?></td>
        <td><?=$lang["costCoeff"]?></td>
        <td><?=$lang["idPictureInput"]?></td>
        <td><?=$lang["funLab"]?></td>
    </tr>

    <?php
        foreach(getMachineList() as $row) {
            if($row['idMachine'] == $_GET['idEdit']) {
                $machine = $row['idMachine'];
                $family = $row['idFamily'];
                ?>
                <tr>
                    <form method="POST" action="">
                        <td><input type="text" name="codeMachine" value="<?= $row['codeMachine'] ?>"/></td>
                        <td><input type="text" name="shortLabel" value="<?= $row['shortLabel'] ?>"/></td>
                        <td><input type="text" name="longLabel" value="<?= $row['longLabel'] ?>"/></td>
                        <td><input type="text" name="serialNumber" value="<?= $row['serialNumber'] ?>"/></td>
                        <td><input type="text" name="manufacturer" value="<?= $row['manufacturer'] ?>"/></td>
                        <td><input type="text" name="comment" value="<?= $row['comment'] ?>"/></td>
                        <td><input type="text" name="docLink1" value="<?= $row['docLink1'] ?>"/></td>
                        <td><input type="text" name="docLink2" value="<?= $row['docLink2'] ?>"/></td>
                        <td>
                            <select name="idFamily" onchange="updateSubList(<?php echo $row['idMachine']?>, this.value)">
                                <option value="<?= $row['idFamily'] ?>" selected="selected"><?= getFamilyName($row['idFamily']) ?></option>
                                <?php
                                foreach (getFamilyList() as $subRow) {
                                    if ($row['idFamily'] != $subRow['idFamily']) {
                                        ?>
                                        <option value="<?= $subRow['idFamily'] ?>"><?= $subRow['familyLabel'] ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </td>
                        <td><div id="idSubFamily"></div></td>
                        <td><input type="number" min="0" name="cost"
                                   value="<?= getCostUnit($row['idCostUnit'])[0] ?>"/></td>
                        <td><input type="number" min="0" step="0.1" name="costCoeff"
                                   value="<?= getCostUnit($row['idCostUnit'])[1] ?>"/></td>
                        <?php if (getPicture($row['idPicture']) != null) { ?>
                            <td>
                                <a href="index.php?page=machine&chooseImage=<?= $row['idMachine'] ?>">
                                    <img src="<?= getPicture($row['idPicture'])['picture'] ?>"
                                         alt="<?= getPicture($row['idPicture'])['pictureDescription'] ?>"
                                </a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <a href="index.php?page=machine&chooseImage=<?= $row['idMachine'] ?>"><?= $lang['edit'] ?></a>
                            </td>
                        <?php } ?>
                        <td>
                            <select name="idLab">
                                <option value="<?= $row['idLab'] ?>"
                                        selected="selected"><?= getLabName($row['idLab']) ?></option>
                                <?php
                                foreach (listAllLab() as $subRow) {
                                    if ($row['idLab'] != $subRow['idLab']) {
                                        ?>
                                        <option value="<?= $subRow['idLab'] ?>"><?= $subRow['labName'] ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </td>
                        <td><input type="submit" value="<?= $lang["submit"] ?>" name="submit"/></td>
                    </form>
                </tr>
                <?php
            }
            else {
    ?>
                <tr>
                    <td><?=$row['codeMachine']?></td>
                    <td><?=$row['shortLabel']?></td>
                    <td><?=$row['longLabel']?></td>
                    <td><?=$row['serialNumber']?></td>
                    <td><?=$row['manufacturer']?></td>
                    <td><?=$row['comment']?></td>
                    <td><?=$row['docLink1']?></td>
                    <td><?=$row['docLink2']?></td>
                    <td><?=getFamilyName($row['idFamily'])?></td>
                    <td><?php
                        foreach(getSubFamilyListMachine($row['idMachine']) as $subRow)
                            echo $subRow['labelSubFamily']." ; ";
                        ?>
                    </td>
                    <td><?=getCostUnit($row['idCostUnit'])[0]?></td>
                    <td><?=getCostUnit($row['idCostUnit'])[1]?></td>
                    <?php if(getPicture($row['idPicture']) != null){ ?>
                        <td><img src = "<?=getPicture($row['idPicture'])['picture']?>" alt = "<?=getPicture($row['idPicture'])['pictureDescription']?>"
                    <?php } else { ?> <td><?php } ?> </td>
                    <td><?=getLabName($row['idLab'])?></td>
                    <td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
                </tr>
    <?php
            }
        }
    ?>

</table>

<script>
    function updateSubList(machine, family) {

        if(machine == "" || family == "") {
            document.getElementById("idSubFamily").innerHTML = "null";
            return;
        }
        else
        {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("idSubFamily").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "requests/subFamilyEdit.php?machine="+machine+"&family="+family,false);
            xmlhttp.send(null);
        }
    }
    updateSubList(<?=$machine ?>, <?=$family?>);
</script>
