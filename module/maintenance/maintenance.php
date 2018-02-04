<?php

/**
 * Create a new regularity between maintenance.
 * @param $name : name of the maintenance.
 * @param $timeBetweenMaintenance : time that we can wait between two maintenance.
 * @param $idMachine : ID of the machine to maintain.
 * @return int : error code if an error occurred or ID of the maintenance if everything passed well.
 */
function createMaintenance($name, $timeBetweenMaintenance, $idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Maintenance(nameMaintenance, timeBetweenMaintenances, idMachine) VALUES(:name, :timeBetweenMaintenance, :idMachine)");

	try {
		$request->execute(array(
			'name' => $name,
			'timeBetweenMaintenance' => $timeBetweenMaintenance,
			'idMachine' => $idMachine
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $DB_DB->lastInsertedId();
}

/**
 * Edit a maintenance.
 * @param $idMaintenance : ID of the maintenance to edit.
 * @param $name : new name of the maintenance.
 * @param $timeBetweenMaintenance : new time that we can wait between two maintenance.
 * @return int : return an error code if an error occurred.
 */
function editMaintenance($idMaintenance, $name, $timeBetweenMaintenance) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Maintenance SET nameMaintenance = :nameMaintenance, timeBetweenMaintenances = :timeBetweenMaintenance WHERE idMaintenance = :idMaintenance");

	try {
		$request->execute(array(
			'name' => $name,
			'timeBetweenMaintenance' => $timeBetweenMaintenance,
			'idMaintenance' => $idMaintenance
		));
	}
	catch(Exception $e) {
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
	$request = $DB_DB->prepare("SELECT * FROM Maintenance WHERE idMaintenance IN (SELECT idMaintenance FROM repair WHERE idMachine = :idMachine);");

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
 * Check the time that remain before the next maintenance of a machine.
 * @param $idMaintenance : ID of maintenance to check.
 * @return mixed : return time that remain before next maintenance or an error code if an error occurred (-1).
 */
function remainTimeMaintenance($idMaintenance) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT dateMaintenance FROM Historical WHERE idHistorical = MAX(SELECT idHistorical FROM Historical WHERE idMaintenance = :idMaintenance)"); // Select the last maintenance date.

	try {
		$request->execute(array(
			'idMaintenance' => $idMaintenance
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $request->fetch();

	// Select all duration since the last maintenance.
	if(empty($result)) {
		$request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");

		try {
			$request->execute(array(
				'idMaintenance' => $idMaintenance
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE dateUseForm >= :dateMaintenance AND idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");

		try {
			$request->execute(array(
				'idMaintenance' => $idMaintenance,
				'dateMaintenance' => $result[0]
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}

	$result = $request->fetch();
	$duration = 0;

	// Add theses duration and compute the remaining time.
	for($count = 0; $count < sizeof($result); $count++)
		$duration += $result[$count];

	$request = $DB_DB->prepare("SELECT timeBetweenMaintenances FROM Maintenance WHERE idMaintenance = :idMaintenance");

	try {
		$request->execute(array(
			'idMaintenance' => $idMaintenance
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$remainingTime = $request->fetch[0] - $duration;

	if($remainingTime < 0)
		return 0;
	else
		return $remainingTime;
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
