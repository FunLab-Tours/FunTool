<?php

// TODO : documentation.
function testSubFamily($id, $sfamilyCode, $sfamilyLabel) {
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
		}
		if($request->rowCount() != 0)
			return false;
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
		}
		if($request->rowCount() != 0)
			return false;
	}
	return true;
}

/**
 * Add a subfamily.
 * @param $subFamilyCode : code of the subfamily.
 * @param $subFamilyLabel : code of the label.
 * @param $idFamily : ID of the main family.
 * @return bool : true if the subfamily has been added, false else.
 */
function addSubFamily($subFamilyCode, $subFamilyLabel, $idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SubFamily(codeSubFamily, labelSubFamily, idFamily) VALUES(:codeSubFamily, :labelSubFamily, :idFamily)');

	if(!testSubFamily(null, $subFamilyCode, $subFamilyLabel))
		return false;

	try {
		$request->execute(array(
			'codeSubFamily' => $subFamilyCode,
			'labelSubFamily' => $subFamilyLabel,
			'idFamily' => $idFamily
		));
	}
	catch(Exception $e) {
		echo $e;
		exit;
	}

	return true;
}

/**
 * Get the list of all subfamilies that exist.
 * @return mixed : all attributes from all subfamilies.
 */
function getAllSubFamilyList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SubFamily");

	try {
		$request->execute();
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}

/**
 * Get the list of all subfamilies for a specific family.
 * @param $idFamily : ID of the main family to check.
 * @return mixed : all attributes from all subfamilies found.
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
	}

	return $request->fetchAll();
}

/**
 * Get the subfamily of a specific machine.
 * @param $idMachine : ID of the machine to check.
 * @return mixed : all attributes of the subfamily found.
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
	}

	return $request->fetchAll();
}

/**
 * Delete a subfamily.
 * @param $idSubFamily : ID of the subfamily to delete.
 */
function deleteSubFamily($idSubFamily) {
	global $DB_DB;

	// We delete all links.
	$request = $DB_DB->prepare('DELETE FROM machineInSubFamily WHERE idSubFamily = :idSubFamily');

	try {
		$request->execute(array(
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		echo $e;
	}

	// Then we delete all subfamilies.
	$request = $DB_DB->prepare('DELETE FROM SubFamily WHERE idSubFamily = :idSubFamily');

	try {
		$request->execute(array(
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		echo $e;
	}
}

/**
 * Edit an existing subfamily.
 * @param $idSubFamily : ID of the subfamily to edit.
 * @param $SubFamilyCode : new code of the subfamily.
 * @param $SubFamilyLabel : new label of the subfamily.
 * @return bool : true if the subfamily has been edited, false else.
 */
function editSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE SubFamily SET  codeSubFamily = :codeSubFamily, labelSubFamily = :labelSubFamily WHERE idSubFamily = :idSubFamily');

	if(!testSubFamily($idSubFamily, $SubFamilyCode, $SubFamilyLabel))
		return false;

	try {
		$request->execute(array(
			'codeSubFamily' => $SubFamilyCode,
			'labelSubFamily' => $SubFamilyLabel,
			'idSubFamily' => $idSubFamily
		));
	}
	catch(Exception $e) {
		echo $e;
	}

	return true;
}

/**
 * Link a machine and a subfamily together.
 * @param $idSubFamily : ID of the subfamily to link.
 * @param $idMachine : ID of the machine to link.
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
		echo $e;
		exit;
	}
}
