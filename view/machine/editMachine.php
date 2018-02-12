<?php

$edit = getMachine($_GET['idEdit']);
$machine = $edit['idMachine'];
$family = $edit['idFamily'];

if(isset($_POST['submit'])) {
	$isValidSignOnReturn = isValidMachineSubmit(true);

	if($isValidSignOnReturn && $isValidSignOnReturn > 0) {
		$errorManager = editMachine($_GET['idEdit'], $_POST['codeMachine'], $_POST['shortLabel'], $_POST['longLabel'], $_POST['machineUsePrice'], $_POST['serialNumber'], $_POST['manufacturer'], $_POST['comment'], $_POST['docLink1'], $_POST['docLink2'], $_POST['idFamily']);

		if($errorManager == "" || ($errorManager && $errorManager > 0)) {
			$errorManager = reassignMaterialsToMachine($machine, $_POST['idMaterials']);

			if($errorManager == "" || ($errorManager && $errorManager > 0))
				header('Location: index.php?page=machine');
			else if($errorManager < 0)
				echo $error[$errorManager];
		}
	}
	else
		echo $error[$isValidSignOnReturn];
}

?>

<!-- Edit form. -->
<form method="POST" action="">
	<input type="text" placeholder="<?=$lang['codeMachineInput']?>" value="<?=$edit['codeMachine']?>" name="codeMachine"/>
	<input type="text" placeholder="<?=$lang['shortLabelInput']?>" value="<?=$edit['shortLabel']?>" name="shortLabel"/>
	<input type="text" placeholder="<?=$lang['longLabelInput']?>" value="<?=$edit['longLabel']?>" name="longLabel"/>
	<input type="number" placeholder="<?=$lang['machineUsePriceInput']?>" value="<?=$edit['machineUsePrice']?>" name="machineUsePrice"/>
	<input type="text" placeholder="<?=$lang['serialNumberInput']?>" value="<?=$edit['serialNumber']?>" name="serialNumber"/>
	<input type="text" placeholder="<?=$lang['manufacturerInput']?>" value="<?=$edit['manufacturer']?>" name="manufacturer"/>
	<input type="text" placeholder="<?=$lang['commentInput']?>" value="<?=$edit['comment']?>" name="comment"/>
	<input type="text" placeholder="<?=$lang['docLink1Input']?>" value="<?=$edit['docLink1']?>" name="docLink1"/>
	<input type="text" placeholder="<?=$lang['docLink2Input']?>" value="<?=$edit['docLink2']?>" name="docLink2"/>

	<!-- Machine family. -->
	<label for="idFamily"><?=$lang['machineFamily']?> : </label>
	<select id="idFamily" name="idFamily">
		<option value=""><?=$lang['machineFamily']?></option>
		<?php
		foreach(getFamilyList() as $row)
			if($row['idFamily'] == $edit['idFamily']) { ?>
				<option value="<?=$row['idFamily']?>" selected="selected"><?=$row['familyLabel']?></option>
			<?php } else { ?>
				<option value="<?=$row['idFamily']?>"><?=$row['familyLabel']?></option>
			<?php } ?>
	</select>

	<!-- Machine materials. -->
	<label for="idMaterials"><?=$lang['machineMaterials']?></label>
	<select id="idMaterials" multiple name="idMaterials[]">
		<option value=""><?=$lang['machineMaterials']?></option>
		<?php
		$materialsList = (array)listMaterials();

		if($materialsList && $materialsList > 0)
			foreach($materialsList as $row)
				if($row['idMat'] == $edit['idMat']) { ?>
					<option value="<?=$row['idMat']?>" selected="selected"><?=$row['labelMat']?></option>
				<?php } else { ?>
					<option value="<?=$row['idMat']?>"><?=$row['labelMat']?></option>
				<?php } ?>
	</select>

	<!-- Machine picture. -->
	<?php if(getPicture($edit['idPicture']) != null) { ?>
		<td>
			<a href="index.php?page=machine&chooseImage=<?=$edit['idMachine']?>">
				<img src="<?=getPicture($edit['idPicture'])['picture']?>"
					 alt="<?=getPicture($edit['idPicture'])['pictureDescription']?>"/>
			</a>
		</td>
	<?php } else { ?>
		<td>
			<a href="index.php?page=machine&chooseImage=<?=$edit['idMachine']?>"><?=$lang['edit']?></a>
		</td>
	<?php } ?>

	<td><input type="submit" value="<?=$lang["submit"]?>" name="submit"/></td>
</form>

<!-- List all other machines. -->
<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["machinePicture"]?></td>
		<td><?=$lang["codeMachineInput"]?></td>
		<td><?=$lang["machineShortLabel"]?></td>
		<td><?=$lang["machineLongLabel"]?></td>
		<td><?=$lang["machineUsePrice"]?></td>
		<td><?=$lang["machineSerialNumber"]?></td>
		<td><?=$lang["machineManufacturer"]?></td>
		<td><?=$lang["machineComment"]?></td>
		<td><?=$lang["machineDocLink1"]?></td>
		<td><?=$lang["machineDocLink2"]?></td>
		<td><?=$lang["machineFamily"]?></td>
		<td><?=$lang["machineMaterials"]?></td>
	</tr>

	<?php
	foreach(getMachineList() as $row) {
	?>
	<tr>
		<?php
		if(getPicture($row['idPicture']) != null) { ?>
			<td><img src="<?=getPicture($row['idPicture'])['picture']?>"
					 alt="<?=getPicture($row['idPicture'])['pictureDescription']?>"</td>
			<?php
		}
		else {
			?>
			<td></td> <?php
		}
		?>

		<td><?=$row['codeMachine']?></td>
		<td><?=$row['shortLabel']?></td>
		<td><?=$row['longLabel']?></td>
		<td><?=$row['machineUsePrice']?>
			<?php
			if($row['machineUsePrice'] == 1)
				echo $lang['funnie'];
			else
				echo $lang['funnies'];
			?></td>
		<td><?=$row['serialNumber']?></td>
		<td><?=$row['manufacturer']?></td>
		<td><?=$row['comment']?></td>
		<td><?=$row['docLink1']?></td>
		<td><?=$row['docLink2']?></td>
		<td><?=getFamilyLabel($row['idFamily'])?></td>

		<td>
			<?php
			$membershipFrameList = (array)getMaterialsMachine($row['idMachine']);

			if($membershipFrameList && $membershipFrameList > 0)
				foreach($membershipFrameList as $material)
					echo $material['labelMat'] . " ; ";
			?>
		</td>
		<td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a>
			| <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>"
				 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a></td>
		<?php
		}
		?>
</table>
