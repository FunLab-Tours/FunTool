<?php

/**
 * Check if a subfamily of machines exits or not.
 * @param $id : ID of the subfamily (can be null).
 * @param $sfamilyCode : code of the subfamily.
 * @param $sfamilyLabel : label of the subfamily.
 * @return bool|int : true if the software category already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsSubFamily($id, $sfamilyCode, $sfamilyLabel) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE codeSubFamily LIKE :sfamilyCode OR labelSubFamily LIKE :sfamilyLabel");

		try {
			$request->execute(array(
				'sfamilyCode' => $sfamilyCode,
				'sfamilyLabel' => $sfamilyLabel
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idSubFamily <> :id AND (codeSubFamily LIKE :sfamilyCode OR labelSubFamily LIKE :sfamilyLabel)");

		try {
			$request->execute(array(
				'sfamilyCode' => $sfamilyCode,
				'sfamilyLabel' => $sfamilyLabel,
				'id' => $id
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * Add a subfamily.
 * @param $subFamilyCode : code of the subfamily.
 * @param $subFamilyLabel : code of the label.
 * @param $idFamily : ID of the main family.
 * @return int : return error code if an error occurred.
 */
function addSubFamily($subFamilyCode, $subFamilyLabel, $idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SubFamily(codeSubFamily, labelSubFamily, idFamily) VALUES(:codeSubFamily, :labelSubFamily, :idFamily)');

	if(!alreadyExistsSubFamily(null, $subFamilyCode, $subFamilyLabel))
		return -3;

	try {
		$request->execute(array(
			'codeSubFamily' => $subFamilyCode,
			'labelSubFamily' => $subFamilyLabel,
			'idFamily' => $idFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get the list of all subfamilies that exist.
 * @return mixed : all attributes from all subfamilies, or error code if an error occurred.
 */
function getAllSubFamilyList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SubFamily");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get the list of all subfamilies for a specific family.
 * @param $idFamily : ID of the main family to check.
 * @return mixed : all attributes from all subfamilies found, or error code if an error occurred.
 */
function getSubFamilyList($idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idFamily = :id");

	try {
		$request->execute(array(
			'id' => $idFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get the subfamily of a specific machine.
 * @param $idMachine : ID of the machine to check.
 * @return mixed : all attributes of the subfamily found, or error code if an error occurred.
 */
function getSubFamilyListMachine($idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SubFamily WHERE idSubFamily IN (SELECT idSubFamily FROM machineInSubFamily WHERE idMachine = :idMachine)");

	try {
		$request->execute(array(
			'idMachine' => $idMachine
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Delete a subfamily.
 * @param $idSubFamily : ID of the subfamily to delete.
 * @return int : error code if an error occurred.
 */
function deleteSubFamily($idSubFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM machineInSubFamily WHERE idSubFamily = :idSubFamily');

	// We delete all links.

	try {
		$request->execute(array(
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	// Then we delete all subfamilies.
	$request = $DB_DB->prepare('DELETE FROM SubFamily WHERE idSubFamily = :idSubFamily');

	try {
		$request->execute(array(
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Edit an existing subfamily.
 * @param $idSubFamily : ID of the subfamily to edit.
 * @param $SubFamilyCode : new code of the subfamily.
 * @param $SubFamilyLabel : new label of the subfamily.
 * @return int : return error code if an error occurred.
 */
function editSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE SubFamily SET  codeSubFamily = :codeSubFamily, labelSubFamily = :labelSubFamily WHERE idSubFamily = :idSubFamily');

	if(!alreadyExistsSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel))
		return -3;

	try {
		$request->execute(array(
			'codeSubFamily' => $SubFamilyCode,
			'labelSubFamily' => $SubFamilyLabel,
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Link a machine and a subfamily together.
 * @param $idSubFamily : ID of the subfamily to link.
 * @param $idMachine : ID of the machine to link.
 * @return int : error code if an error occurred.
 */
function linkSubFamilyWithMachine($idSubFamily, $idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO machineInSubFamily(idMachine, idSubFamily) VALUES(:idMachine, :idSubFamily)');

	try {
		$request->execute(array(
			'idSubFamily' => $idSubFamily,
			'idMachine' => $idMachine
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}
