<?php

/**
 * Check if there are labs in the database or not.
 * @return bool : true if there is no lab, false else, or an error code if an error occurred.
 */
function noLab() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(labName) as nb_entry FROM Lab");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	if($request->fetch()['nb_entry'] == 0)
		return true;
	return false;
}
