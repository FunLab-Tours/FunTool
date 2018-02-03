<?php

/**
 * Add an entry to say that a user maintained a machine.
 * @param $idMachine : ID of maintained machine.
 * @param $idUser : ID of the user that maintained the machine.
 * @param $message : message or comment about the maintenance.
 * @param $date : date of the maintenance.
 * @return int|mixed : error code if needed, else nothing.
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
		return $e->getCode();
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
		return $e->getCode();
	}

	return "";
}

/**
 * Get the historical of maintenance for a specific machine.
 * @param $idMachine : ID of the machine to check.
 * @return int|mixed : error code if needed, else nothing.
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
		return $e->getCode();
	}

	return $request->fetchAll()[0];
}
