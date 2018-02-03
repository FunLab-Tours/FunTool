<?php

/**
 * Add a cost unit.
 * @param $timePackage : time of the cost unit.
 * @param $coeffTime : coefficient for the time of the cost unit.
 */
function addCostUnit($timePackage, $coeffTime) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO CostUnit(timePackage, coeffTime) VALUES(:timePackage, :coeffTime)');

	try {
		$request->execute(array(
			'timePackage' => $timePackage,
			'coeffTime' => $coeffTime
		));
	}
	catch(Exception $e) {
		echo $e;
		exit;
	}
}

/**
 * Get all costs unit.
 * @return mixed : all costs unit with all attributes.
 */
function getCostUnitList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM costUnit");

	try {
		$request->execute();
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}

/**
 * Delete a cost unit.
 * @param $idDelete : ID of cost unit to delete.
 */
function deleteCostUnit($idDelete) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM costUnit WHERE idCostUnit = :idCostUnit');

	try {
		$request->execute(array(
			'idCostUnit' => $idDelete
		));
	}
	catch(Exception $e) {
		echo $e;
	}
}

/**
 * Edit a cost unit.
 * @param $idCostUnit : ID of the cost unit to edit.
 * @param $timePackage : new time for the cost unit.
 * @param $coeffTime : new coefficient for the cost unit.
 */
function editCostUnit($idCostUnit, $timePackage, $coeffTime) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE costUnit SET  timePackage = :timePackage, coeffTime = :coeffTime, WHERE idCostUnit = :idCostUnit');

	try {
		$request->execute(array(
			'timePackage' => $timePackage,
			'coeffTime' => $coeffTime,
			'idCostUnit' => $idCostUnit
		));
	}
	catch(Exception $e) {
		echo $e;
	}
}

/**
 * Get the ID of a cost unit.
 * @param $timePackage : time of the cost unit to search.
 * @param $costCoeff : coefficient of the cost unit to search.
 * @return mixed : ID of the searched cost unit.
 */
function getIdCostUnit($timePackage, $costCoeff) {
	// We check if cost exists, if yes we get its ID, else we create it and we get its ID.
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT idCostUnit FROM costunit WHERE timePackage LIKE :timePackage AND coeffTime LIKE :coeffTime');

	try {
		$request->execute(array(
			'timePackage' => $timePackage,
			'coeffTime' => $costCoeff
		));
	}
	catch(Exception $e) {
		echo $e;
		exit;
	}

	if($request->rowCount() == 0) {
		addCostUnit($timePackage, $costCoeff);
		return $DB_DB->lastInsertId();
	}
	else
		return $request->fetch()[0];
}
