<?php

/**
 * Add a FabLab.
 * @param $labName : name of the FabLab.
 * @param $labDescription : description of the FabLab.
 * @return int|mixed : error code if an error occurred, else nothing.
 */
function addLab($labName, $labDescription) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO Lab(labName, labDescription) VALUES (:labName, :labDescription)");

	try {
		$stmt->execute(array(
			'labName' => $labName,
			'labDescription' => $labDescription
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}
}

/**
 * Delete a FabLab.
 * @param $idLab : ID of the FabLab to delete.
 * @return int|mixed : error code if an error occurred, else nothing.
 */
function deleteLab($idLab) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM Lab WHERE idLab = :idLab");

	try {
		$stmt->execute(array(
			'idLab' => $idLab
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}
}

/**
 * Update information about a FabLab.
 * @param $idLab : ID of the FabLab to edit.
 * @param $labName : new name of the FabLab.
 * @param $labDescription : new description of the FabLab.
 * @return int|mixed : error code if an error occurred, else nothing.
 */
function updateLab($idLab, $labName, $labDescription) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE Lab SET labName = :labName, labDescription = :labDescription WHERE idLab = :idLab");

	try {
		$stmt->execute(array(
			'labName' => $labName,
			'labDescription' => $labDescription,
			'idLab' => $idLab
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}
}

/**
 * Get all existing labs.
 * @return int|mixed : all attributes about all labs or error code if an error occurred.
 */
function listAllLab() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Lab");

	try {
		$request->execute(array());
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetchAll();
}

/**
 * Check if a lab name is ever used or not.
 * @param $labName : lab name to check.
 * @return bool|int|mixed : return true if the lab name is never used, false else. It can return an error code if an error occurred.
 */
function isValidLab($labName) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(labName) as nb_entry FROM lab WHERE labName = :labName");

	if($labName == "")
		return false;

	try {
		$request->execute(array(
			'labName' => $labName,
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	if($request->fetch()['nb_entry'] == 0)
		return true;
	return false;
}

/**
 * Get the name of a lab.
 * @param $idLab : ID of the lab to check.
 * @return int|mixed : lab name or error code if an error occurred.
 */
function getLabName($idLab) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT labName FROM lab WHERE idLab =: idLab');

	try {
		$request->execute(array(
			'idLab' => $idLab
		));
	}
	catch(Exception $e) {
		return $e->getCode();
	}

	return $request->fetch()[0];
}
