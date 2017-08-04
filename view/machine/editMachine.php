<?php
    if(isset($_POST['submit'])) {
        if(isValidMachineSubmit()) {
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
                Null,
                $_POST['cost'],
                $_POST['costCoeff'],
                NULL

            );
            header('Location: index.php?page=machine');
        }
    }
?>

<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["machineName"]?></td>
            <td><?=$lang["machineShortLabel"]?></td>
            <td><?=$lang["machineLongLabel"]?></td>
            <td><?=$lang["machineSerialNumber"]?></td>
            <td><?=$lang["machineManufacturer"]?></td>
            <td><?=$lang["machineComment"]?></td>
            <td><?=$lang["machineDocLink1"]?></td>
            <td><?=$lang["machineDocLink2"]?></td>
            <td><?=$lang["machineFamily"]?></td>
            <td><?=$lang["cost"]?></td>
            <td><?=$lang["costCoeff"]?></td>
        </tr>

        <?php
            foreach(getMachineList() as $row) {
                if($row['idMachine'] == $_GET['idEdit']) {
                    //print_r(array_keys($row));
                    print_r(getCostUnit($row['idCostUnit'])[0]);
                    print_r(getCostUnit($row['idCostUnit'])[1]);
        ?>
                    <tr>
                        <form method="POST" action="">
                            <td><input type="text" name="codeMachine" value="<?=$row['codeMachine']?>" /></td>
                            <td><input type="text" name="shortLabel" value="<?=$row['shortLabel']?>" /></td>
                            <td><input type="text" name="longLabel" value="<?=$row['longLabel']?>" /></td>
                            <td><input type="text" name="serialNumber" value="<?=$row['serialNumber']?>" /></td>
                            <td><input type="text" name="manufacturer" value="<?=$row['manufacturer']?>" /></td>
                            <td><input type="text" name="comment" value="<?=$row['comment']?>" /></td>
                            <td><input type="text" name="docLink1" value="<?=$row['docLink1']?>" /></td>
                            <td><input type="text" name="docLink2" value="<?=$row['docLink2']?>" /></td>
							<td>
								<select name ="idFamily">
									<option value=<?=$row['idFamily']?> selected="selected"><?=getFamilyName($row['idFamily'])?></option>
								<?php
									foreach(getFamilyList() as $subRow){
									    if($row['idFamily'] != $subRow['idFamily']){?>
										<option value="<?=$subRow['idFamily']?>"><?=$subRow['familyLabel']?></option>
									<?php }
									} ?>
									
								</select>
							</td>
                            <td><input type="number" min="0" name="cost" value="<?=getCostUnit($row['idCostUnit'])[0]?>" /></td>
                            <td><input type="number" min="0" step="0.1" name="costCoeff" value="<?=getCostUnit($row['idCostUnit'])[1]?>" /></td>
                            <td><input type="submit" value="<?=$lang["submit"]?>" name="submit" /></td>
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
                        <td><?=getCostUnit($row['idCostUnit'])[0]?></td>
                        <td><?=getCostUnit($row['idCostUnit'])[1]?></td>
                        <td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
                    </tr>
        <?php
                }
            }
        ?>

    </table>
</body>
