<?php

if(isset($_POST['submit'])) {
	$errorManager = isValidMachineSubmit();

	if($errorManager == "" || ($errorManager && $errorManager > 0)) {
		$errorManager = addMachine($_POST['codeMachine'], $_POST['shortLabel'], $_POST['longLabel'], $_POST['machineUsePrice'], $_POST['serialNumber'], $_POST['manufacturer'], $_POST['comment'], $_POST['docLink1'], $_POST['docLink2'], $_POST['idFamily']);
		$id = $errorManager;

		if($errorManager == "" || ($errorManager && $errorManager > 0)) {
			$errorManager = assignMaterialsToMachine($id, $_POST['idMaterials']);

			if($errorManager == "" || ($errorManager && $errorManager > 0))
				header('Location: index.php?page=machine&listMachine');
			//header('Location: index.php?page=machine&chooseImage=' . $id); // TODO : add pictures.
			else if($errorManager < 0)
				echo $error[$errorManager];
		}
		else if($errorManager < 0)
			echo $error[$errorManager];
	}
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<form action="" method="post">
	<input type="text" placeholder="<?=$lang['codeMachineInput']?>" name="codeMachine"/>
	<input type="text" placeholder="<?=$lang['shortLabelInput']?>" name="shortLabel"/>
	<input type="text" placeholder="<?=$lang['longLabelInput']?>" name="longLabel"/>
	<input type="number" placeholder="<?=$lang['machineUsePriceInput']?>" name="machineUsePrice"/>
	<input type="text" placeholder="<?=$lang['serialNumberInput']?>" name="serialNumber"/>
	<input type="text" placeholder="<?=$lang['manufacturerInput']?>" name="manufacturer"/>
	<input type="text" placeholder="<?=$lang['commentInput']?>" name="comment"/>
	<input type="text" placeholder="<?=$lang['docLink1Input']?>" name="docLink1"/>
	<input type="text" placeholder="<?=$lang['docLink2Input']?>" name="docLink2"/>

	<label for="idFamily"><?=$lang['machineFamily']?> : </label>
	<select id="idFamily" name="idFamily">
		<option value="" selected="selected"><?=$lang['machineFamily']?></option>
		<?php
		foreach(getFamilyList() as $row) { ?>
			<option value="<?=$row['idFamily']?>"><?=$row['familyLabel']?></option>
		<?php } ?>
	</select>

	<label for="idMaterials"><?=$lang['machineMaterials']?></label>
	<select id="idMaterials" multiple name="idMaterials[]">
		<option value="" selected="selected"><?=$lang['machineMaterials']?></option>
		<?php
		$materialsList = (array)listMaterials();

		if($materialsList && $materialsList > 0)
			foreach($materialsList as $row) { ?>
				<option value="<?=$row['idMat']?>"><?=$row['labelMat']?></option>
			<?php } ?>
	</select>

	<input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>
