<?php

// TODO : documentation.
function testFamily($id, $familyCode, $familyLabel) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM Family WHERE familyCode LIKE :familyCode OR familyLabel LIKE :familyLabel");

		try {
			$request->execute(array(
				'familyCode' => $familyCode,
				'familyLabel' => $familyLabel
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM Family WHERE idFamily <> :id AND (familyCode LIKE :familyCode OR familyLabel LIKE :familyLabel)");

		try {
			$request->execute(array(
				'id' => $id,
				'familyCode' => $familyCode,
				'familyLabel' => $familyLabel
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
 * Add a family for machines.
 * @param $familyCode : code of the family.
 * @param $familyLabel : label of the family.
 * @return int : return error code if an error occurred.
 */
function addFamily($familyCode, $familyLabel) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Family(familyCode, familyLabel) VALUES(:familyCode, :familyLabel)');

	if(!testFamily(null, $familyCode, $familyLabel))
		return -3;

	try {
		$request->execute(array(
			'familyCode' => $familyCode,
			'familyLabel' => $familyLabel
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get the list of all families.
 * @return mixed : all attributes of all families, or error code if an error occurred.
 */
function getFamilyList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Family");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get a family label.
 * @param $idFamily : ID of the family to get.
 * @return mixed : family label found, or error code if an error occurred.
 */
function getFamilyLabel($idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT familyLabel FROM Family WHERE idFamily = :idFamily');

	try {
		$request->execute(array(
			'idFamily' => $idFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetch()[0];
}

/**
 * Delete an existing family. We replace by null all machine that used this family.
 * @param $idDelete : ID of the family to delete.
 * @return int : return error code if an error occurred.
 */
function deleteFamily($idDelete) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Machine SET idFamily = null WHERE idFamily = :idFamily');

	try {
		$request->execute(array(
			'idFamily' => $idDelete
		));
	}
	catch(Exception $e) {
		return -2;
	}

	// We delete subfamilies.
	foreach(getSubFamilyList($idDelete) as $subFamily)
		deleteSubFamily($subFamily['idSubFamily']);

	// Then we delete the family.
	$request = $DB_DB->prepare('DELETE FROM Family WHERE idFamily = :idDelete');

	try {
		$request->execute(array(
			'idDelete' => $idDelete
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Edit an existing family.
 * @param $idFamily : ID of the family to edit.
 * @param $familyCode : new code of the family.
 * @param $familyLabel : new label of the family.
 * @return int : return error code if an error occurred.
 */
function editFamily($idFamily, $familyCode, $familyLabel) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Family SET  familyCode = :familyCode, familyLabel = :familyLabel WHERE idFamily = :idFamily');

	if(!testFamily($idFamily, $familyCode, $familyLabel))
		return -3;

	try {
		$request->execute(array(
			'familyCode' => $familyCode,
			'familyLabel' => $familyLabel,
			'idFamily' => $idFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Count the number of existing subfamilies.
 * @param $idFamily : ID of the family to check.
 * @return mixed : number of subfamilies, or error code if an error occurred.
 */
function countNbrSubFamily($idFamily) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(*) FROM SubFamily WHERE idFamily = :idFamily");

	try {
		$request->execute(array(
			'idFamily' => $idFamily
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetch()[0];
}
