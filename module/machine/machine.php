<?php

/**
 * Check if the submit for a new machine or an edit is valid.
 * @param bool $isEdit : true if it's to edit a machine, false if it's to add a new one.
 * @return int : return true if the submit is valid or an error code else.
 */
function isValidMachineSubmit($isEdit = false) {
	if(!$isEdit) {
		if(!isset($_POST['codeMachine']) || !isValidCodeMachine($_POST['codeMachine']) || $_POST['codeMachine'] == "")
			return -17;

		if(!isset($_POST['shortLabel']) || !isValidShortLabel($_POST['shortLabel']) || $_POST['shortLabel'] == "")
			return -18;
	}

	if(!isset($_POST['longLabel']) || !isValidLongLabel($_POST['longLabel']) || $_POST['longLabel'] == "")
		return -19;

	if(!isset($_POST['serialNumber']) || !isValidSerialNumber($_POST['serialNumber']) || $_POST['serialNumber'] == "")
		return -20;

	if(!isset($_POST['manufacturer']) || !isValidManufacturer($_POST['manufacturer']) || $_POST['manufacturer'] == "")
		return -21;

	if(!isset($_POST['idFamily']) || $_POST['idFamily'] == "")
		return -25;

	return true;
}

/**
 * Check if the code for the machine is valid or not.
 * @param $codeMachine : code of the machine.
 * @return bool : true if the code is valid, false else, or error code if an error occurred.
 */
function isValidCodeMachine($codeMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Machine WHERE codeMachine LIKE :codeMachine");

	try {
		$request->execute(array(
			'codeMachine' => $codeMachine
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * Check if the short label of the machine is valid or not.
 * @param $shortLabel : short label of the machine.
 * @return bool : true if the label is valid, false else, or error code if an error occurred.
 */
function isValidShortLabel($shortLabel) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Machine WHERE shortLabel LIKE :shortLabel");

	try {
		$request->execute(array(
			'shortLabel' => $shortLabel
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * Check if a long label is valid or not.
 * @param $longLabel : long label of the machine.
 * @return bool : true if the label is valid, false else.
 */
function isValidLongLabel($longLabel) {
	unset($longLabel);
	return true;
}

/**
 * Check if a use price is valid or not.
 * @param $machineUsePrice : use price of the machine.
 * @return bool : true if the use price is valid, false else.
 */
function isValidMachineUsePrice($machineUsePrice) {
	if(is_numeric($machineUsePrice) && $machineUsePrice > 0)
		return true;
	return false;
}

/**
 * Check if the serial number of the machine is valid or not.
 * @param $serialNumber : serial number of the machine.
 * @return bool : true if the serial number is valid, false else.
 */
function isValidSerialNumber($serialNumber) {
	unset($serialNumber);
	return true;
}

/**
 * Check if the manufacturer of a machine is valid or not.
 * @param $manufacturer : manufacturer of the machine.
 * @return bool : true if the manufacturer is valid, false else.
 */
function isValidManufacturer($manufacturer) {
	unset($manufacturer);
	return true;
}

/**
 * Check if the comment about the machine is valid or not.
 * @param $comment : comment of the machine.
 * @return bool : true if the comment is valid, false else.
 */
function isValidComment($comment) {
	unset($comment);
	return true;
}

/**
 * Check if the link for the documentation is valid or not.
 * @param $docLink : link of the documentation.
 * @return bool : true if the documentation link is valid, false else.
 */
function isValidDocLink($docLink) {
	unset($docLink);
	return true;
}

/**
 * Add a machine to the database.
 * @param $codeMachine : code of the machine.
 * @param $shortLabel : short label of the machine.
 * @param $longLabel : long label of the machine.
 * @param $machineUsePrice : price of the machine for one hour of utilisation.
 * @param $serialNumber : serial number of the machine.
 * @param $manufacturer : manufacturer of the machine.
 * @param $comment : comment about the machine (if needed).
 * @param $docLink1 : documentation link about the machine.
 * @param $docLink2 : second documentation link about the machine (if needed).
 * @param $idFamily : ID of the family of the machine.
 * @return int : return error code if an error occurred.
 */
function addMachine($codeMachine, $shortLabel, $longLabel, $machineUsePrice, $serialNumber, $manufacturer, $comment, $docLink1, $docLink2, $idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Machine(codeMachine, shortLabel, longLabel, machineUsePrice, serialNumber, manufacturer, comment, docLink1, docLink2, dateEntry, idFamily, idPicture) VALUES (:codeMachine, :shortLabel, :longLabel, :machineUsePrice, :serialNumber, :manufacturer, :comment, :docLink1, :docLink2, NOW(), :idFamily, :idPicture)');

	try {
		$request->execute(array(
			'codeMachine' => $codeMachine,
			'shortLabel' => $shortLabel,
			'longLabel' => $longLabel,
			'machineUsePrice' => $machineUsePrice,
			'serialNumber' => $serialNumber,
			'manufacturer' => $manufacturer,
			'comment' => $comment,
			'docLink1' => $docLink1,
			'docLink2' => $docLink2,
			'idFamily' => $idFamily,
			'idPicture' => NULL,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$idMachine = $DB_DB->lastInsertId();

	return $idMachine;
}

/**
 * Get the list of all machines.
 * @return mixed : list with all machine with all attributes, or error code if an error occurred.
 */
function getMachineList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Machine");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get a specific machine.
 * @param $id : ID of the machine to get.
 * @return mixed : all attributes of the machine, or error code if an error occurred.
 */
function getMachine($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Machine WHERE idMachine = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetch();
}

/**
 * Edit an existing machine.
 * @param $idMachine : ID of the machine to edit.
 * @param $codeMachine : new code of the machine.
 * @param $shortLabel : new short label of the machine.
 * @param $longLabel : new long label of the machine.
 * @param $machineUsePrice : price of the machine for one hour of using it.
 * @param $serialNumber : new serial number of the machine.
 * @param $manufacturer : new manufacturer of the machine.
 * @param $comment : new comment about the machine (if needed).
 * @param $docLink1 : new documentation link about the machine.
 * @param $docLink2 : new second documentation link about the machine (if needed).
 * @param $idFamily : new ID of the family of the machine.
 * @param $idsSubFamily
 * @return int|string : return error code if an error occurred.
 */
function editMachine($idMachine, $codeMachine, $shortLabel, $longLabel, $machineUsePrice, $serialNumber, $manufacturer, $comment, $docLink1, $docLink2, $idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Machine SET  codeMachine = :codeMachine,
													shortLabel = :shortLabel,
													longLabel = :longLabel,
													machineUsePrice = :machineUsePrice,
													serialNumber = :serialNumber,
													manufacturer = :manufacturer,
													comment = :comment,
													docLink1 = :docLink1,
													docLink2 = :docLink2,
													idFamily = :idFamily,
													idPicture = :idPicture
                                    WHERE idMachine = :idMachine');

	try {
		$request->execute(array(
			'idMachine' => $idMachine,
			'codeMachine' => $codeMachine,
			'shortLabel' => $shortLabel,
			'longLabel' => $longLabel,
			'machineUsePrice' => $machineUsePrice,
			'serialNumber' => $serialNumber,
			'manufacturer' => $manufacturer,
			'comment' => $comment,
			'docLink1' => $docLink1,
			'docLink2' => $docLink2,
			'idFamily' => $idFamily,
			'idPicture' => NULL
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

/**
 * Delete an existing machine.
 * @param $idDelete : ID of the machine to delete.
 * @return int : return error code if an error occurred.
 */
function deleteMachine($idDelete) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM machineInSubFamily WHERE idMachine = :idMachine');

	unassignMaterialsFromMachine($idDelete);

	try {
		$request->execute(array(
			'idMachine' => $idDelete,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$request = $DB_DB->prepare('DELETE FROM Machine WHERE idMachine = :idMachine');

	try {
		$request->execute(array(
			'idMachine' => $idDelete
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

/**
 * Get the list of all pictures about machines.
 * @return mixed : all attributes from all pictures of machines, or error code if an error occurred.
 */
function getListPictureMachine() {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT * FROM picture WHERE categoryPicture LIKE \'machine\'');

	try {
		$request->execute();
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Assign a picture to a machine.
 * @param $idMachine : ID of the machine to add a picture.
 * @param $idPicture : ID of the picture to add to the machine.
 * @return int : return error code if an error occurred.
 */
function assignPicture($idMachine, $idPicture) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Machine SET idPicture = :idPicture WHERE idMachine = :idMachine');

	try {
		$request->execute(array(
			'idMachine' => $idMachine,
			'idPicture' => $idPicture
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

/**
 * Create a picture and assign it to a machine.
 * @param $idMachine : ID of the machine to add the picture.
 * @param $urlPicture : URL of the picture to add.
 * @param $descriptionPicture : description of the picture to add.
 * @return int : return error code if an error occurred.
 */
function addPictureAndAssign($idMachine, $urlPicture, $descriptionPicture) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Picture(picture, pictureDescription) VALUES(:picture, :pictureDescription)');

	try {
		$request->execute(array(
			'picture' => $urlPicture,
			'pictureDescription' => $descriptionPicture,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	assignPicture($idMachine, $DB_DB->lastInsertId());
}
