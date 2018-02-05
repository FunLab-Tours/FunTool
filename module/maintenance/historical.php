<?php

/**
 * Add an entry to say that a user maintained a machine.
 * @param $idMachine : ID of maintained machine.
 * @param $idUser : ID of the user that maintained the machine.
 * @param $message : message or comment about the maintenance.
 * @param $date : date of the maintenance.
 * @return int : return an error code if an error occurred.
 */
function haveUserMaintainedMachine($idMachine, $idUser, $message, $date) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT idMaintenance FROM Maintenance WHERE idMachine = :idMachine");

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

	$idMaintenance = $request->fetch()[0];

	$request = $DB_DB->prepare("INSERT INTO Historical(messageRepaire, idUser, dateMaintenance, idMaintenance) VALUES(:message, :idUser, :date, :idMaintenance)");

	try {
		$request->execute(array(
			'message' => $message,
			'idUser' => $idUser,
			'date' => $date,
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
 * Get the historical of maintenance for a specific machine.
 * @param $idMachine : ID of the machine to check.
 * @return mixed : return information about all historic, or an error code if an error occurred.
 */
function getMaintenanceHistorical($idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Historical WHERE idMaintenance IN (SELECT idMaintenance FROM Maintenance WHERE idMachine = :idMachine)");

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

	return $request->fetchAll()[0];
}
