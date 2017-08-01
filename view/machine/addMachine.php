<?php
    if(isset($_POST['submit'])) {
        if(isValidMachineSubmit()) {
            addMachine( $_POST['codeMachine'],
                        $_POST['shortLabel'],
                        $_POST['longLabel'],
                        $_POST['machineUsePrice'],
                        $_POST['serialNumber'],
                        $_POST['manufacturer'],
                        $_POST['comment'],
                        $_POST['docLink1'],
                        $_POST['docLink2'],
                        $_POST['idFamily'],
                        $_POST['idPicture'],
                        $_POST['idCostUnit'],
                        $_POST['idLab']
            );
            header('Location: index.php?page=machine');
        }
    }
?>

<body>
	<form action="" method="post">
		<input type="text" placeholder="<?=$lang['codeMachineInput']?>" name="codeMachine" />
		<input type="text" placeholder="<?=$lang['shortLabelInput']?>" name="shortLabel" />
		<input type="text" placeholder="<?=$lang['longLabelInput']?>" name="longLabel" />
		<input type="text" placeholder="<?=$lang['machineUsePriceInput']?>" name="machineUsePrice" />
		<input type="text" placeholder="<?=$lang['serialNumberInput']?>" name="serialNumber" />
		<input type="text" placeholder="<?=$lang['manufacturerInput']?>" name="manufacturer" />
		<input type="text" placeholder="<?=$lang['commentInput']?>" name="comment" />
		<input type="text" placeholder="<?=$lang['docLink1Input']?>" name="docLink1" />
		<input type="text" placeholder="<?=$lang['docLink2Input']?>" name="docLink2" />
		<input type="text" placeholder="<?=$lang['idMachineFamilyInput']?>" name="idFamily" />
		<input type="text" placeholder="<?=$lang['idPictureInput']?>" name="idPicture" />
		<input type="text" placeholder="<?=$lang['idCostUnitInput']?>" name="idCostUnit" />
		<input type="text" placeholder="<?=$lang['idLabInput']?>" name="idLab" />
		<input type="submit" value="<?=$lang["submit"]?>" name="submit">
	</form>
</body>
