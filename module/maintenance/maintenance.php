<?php

/**
 * Create a new regularity between maintenance.
 * @param $maintenanceName : name of the maintenance.
 * @param $daysBetweenMaintenance : time that we can wait between two maintenance.
 * @param $idMachine : ID of the machine to maintain.
 * @return int|string : error code if an error occurred.
 */
function createMaintenance($maintenanceName, $daysBetweenMaintenance, $idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Maintenance(nameMaintenance, daysBetweenMaintenance, idMachine) VALUES(:maintenanceName, :daysBetweenMaintenance, :idMachine)");

	try {
		$request->execute(array(
			'maintenanceName' => $maintenanceName,
			'daysBetweenMaintenance' => $daysBetweenMaintenance,
			'idMachine' => $idMachine
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
 * Edit a maintenance.
 * @param $idMaintenance : ID of the maintenance to edit.
 * @param $name : new name of the maintenance.
 * @param $daysBetweenMaintenance : new time that we can wait between two maintenance.
 * @return int : return an error code if an error occurred.
 */
function editMaintenance($idMaintenance, $name, $daysBetweenMaintenance) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Maintenance SET nameMaintenance = :nameMaintenance, daysBetweenMaintenances = :daysBetweenMaintenance WHERE idMaintenance = :idMaintenance");

	try {
		$request->execute(array(
			'name' => $name,
			'daysBetweenMaintenance' => $daysBetweenMaintenance,
			'idMaintenance' => $idMaintenance
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
 * Delete a maintenance.
 * @param $idMaintenance : ID of maintenance to delete.
 * @return int : error code if an error occurred, nothing else.
 */
function deleteMaintenance($idMaintenance) {
	global $DB_DB;
	$request = $DB_DB->prepapre("DELETE FROM Maintenance WHERE idMaintenant = :idMaintenance");

	try {
		$request->execute(array(
			'idMaintenance' => $idMaintenance
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
 * Get information about a maintenance.
 * @param $idMaintenance : ID of maintenance to get.
 * @return mixed : all attributes of the maintenance or an error code if an error occurred.
 */
function getMaintenance($idMaintenance) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Maintenance WHERE idMaintenance = :idMaintenance");

	try {
		$request->execute(array(
			'idMaintenance' => $idMaintenance
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll()[0];
}

/**
 * List all maintenance about a machine.
 * @param $idMachine : ID of the machine to check.
 * @return mixed : list of maintenance with all attributes or an error code if an error occurred.
 */
function listMaintenance($idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Maintenance WHERE idMachine = :idMachine");

	try {
		$request->execute(array(
			'idMachine' => $idMachine
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Check the time that remain before the next maintenance of a machine.
 * @param $idMaintenance : ID of maintenance to check.
 * @return mixed : return time that remain before next maintenance or an error code if an error occurred (-1).
 */
function remainTimeMaintenance($idMaintenance) { // TODO : correct this function.
//	global $DB_DB;
//	$request = $DB_DB->prepare("SELECT dateMaintenance FROM Historical WHERE idHistorical = MAX(SELECT idHistorical FROM Historical WHERE idMaintenance = :idMaintenance)"); // Select the last maintenance date.
//
//	try {
//		$request->execute(array(
//			'idMaintenance' => $idMaintenance
//		));
//	}
//	catch(Exception $e) {
//		if($DEBUG_MODE)
//			echo $e;
//		return -2;
//	}
//
//	$lastDateMaintenance = $request->fetch();
//
//	// Select all duration since the last maintenance.
//	if(empty($lastDateMaintenance)) {
//		$request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");
//
//		try {
//			$request->execute(array(
//				'idMaintenance' => $idMaintenance
//			));
//		}
//		catch(Exception $e) {
//			if($DEBUG_MODE)
//				echo $e;
//			return -2;
//		}
//	}
//	else {
//		$request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE dateUseForm >= :dateMaintenance AND idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");
//
//		try {
//			$request->execute(array(
//				'idMaintenance' => $idMaintenance,
//				'dateMaintenance' => $lastDateMaintenance['dateMaintenance']
//			));
//		}
//		catch(Exception $e) {
//			if($DEBUG_MODE)
//				echo $e;
//			return -2;
//		}
//	}
//
//	$result = $request->fetch();
//	$duration = 0;
//
//	// Add theses duration and compute the remaining time.
//	for($count = 0; $count < sizeof($result); $count++)
//		$duration += $result[$count];
//
//	$request = $DB_DB->prepare("SELECT daysBetweenMaintenance FROM Maintenance WHERE idMaintenance = :idMaintenance");
//
//	try {
//		$request->execute(array(
//			'idMaintenance' => $idMaintenance
//		));
//	}
//	catch(Exception $e) {
//		if($DEBUG_MODE)
//			echo $e;
//		return -2;
//	}
//
//	$remainingTime = $request->fetch[0] - $duration;
//
//	if($remainingTime >= 0)
//		return $remainingTime;
	return 0;
}

/**
 * Check the list of all maintenance to be done.
 * @return array : list of all maintenance to be done.
 */
function listMaintenanceToBeDone() {
	global $DB_DB;

	$maintenance = $DB_DB->query("SELECT * FROM Maintenance")->fetchAll();

	$toBeDone = array();

	foreach($maintenance as $currentMaintenance) {
		if(remainTimeMaintenance($currentMaintenance['idMaintenance']) != 0)
			array_push($toBeDone, $currentMaintenance);
	}

	return $toBeDone;
}
