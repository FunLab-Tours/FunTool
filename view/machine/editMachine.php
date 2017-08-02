<?php
    if(isset($_POST['submit'])) {
        echo "Ok";
        editMachine($_GET['idEdit'],
                    $_POST['codeMachine'],
                    $_POST['shortLabel'],
                    $_POST['longLabel'],
                    $_POST['machineUsePrice'],
                    $_POST['serialNumber'],
                    $_POST['manufacturer'],
                    $_POST['comment'],
                    $_POST['docLink1'],
                    $_POST['docLink2'],
                    $_POST['idFamily'],
					null,
					null,
					null
        );
        header('Location: index.php?page=machine');
    }
?>

<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["machineName"]?></td>
            <td><?=$lang["machineShortLabel"]?></td>
            <td><?=$lang["machineLongLabel"]?></td>
            <td><?=$lang["machineUsePrice"]?></td>
            <td><?=$lang["machineSerialNumber"]?></td>
            <td><?=$lang["machineManufacturer"]?></td>
            <td><?=$lang["machineComment"]?></td>
            <td><?=$lang["machineDocLink1"]?></td>
            <td><?=$lang["machineDocLink2"]?></td>
            <td><?=$lang["machineFamily"]?></td>
        </tr>

        <?php
            foreach(getMachineList() as $row) {
                if($row['idMachine'] == $_GET['idEdit']) {
        ?>
                    <tr>
                        <form method="POST" action="">
                            <td><input type="text" name="codeMachine" value="<?=$row['codeMachine']?>" /></td>
                            <td><input type="text" name="shortLabel" value="<?=$row['shortLabel']?>" /></td>
                            <td><input type="text" name="longLabel" value="<?=$row['longLabel']?>" /></td>
                            <td><input type="text" name="machineUsePrice" value="<?=$row['machineUsePrice']?>" /></td>
                            <td><input type="text" name="serialNumber" value="<?=$row['serialNumber']?>" /></td>
                            <td><input type="text" name="manufacturer" value="<?=$row['manufacturer']?>" /></td>
                            <td><input type="text" name="comment" value="<?=$row['comment']?>" /></td>
                            <td><input type="text" name="docLink1" value="<?=$row['docLink1']?>" /></td>
                            <td><input type="text" name="docLink2" value="<?=$row['docLink2']?>" /></td>
							<td>
								<select name ="idFamily">
									<option value="" selected="selected"><?=$lang['machineFamily']?></option>
								<?php
									foreach(getFamilyList() as $row){?>
										<option value="<?=$row['idFamily']?>"><?=$row['familyLabel']?></option>
									<?php ;} ?>
									
								</select>
							</td>
                            <td><input type="submit" value="<?=$lang["submit"]?>" name="submit">
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
                        <td><?=$row['machineUsePrice']?></td>
                        <td><?=$row['serialNumber']?></td>
                        <td><?=$row['manufacturer']?></td>
                        <td><?=$row['comment']?></td>
                        <td><?=$row['docLink1']?></td>
                        <td><?=$row['docLink2']?></td>
						<td>
						<?php
							foreach(getFamilyName($row['idFamily']) as $id){?>
								<?=$id['familyLabel']?>
							<?php ;} ?>
						</td>
                        <td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
                    </tr>
        <?php
                }
            }
        ?>

    </table>
</body>
