<?php

/**
 * Get the number of funnies from a user.
 * @param $idUser : ID of the user to check/
 * @return int|mixed : number of funnies or an error code if an error occurred.
 */
function currentUserFunnies($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT nbFunnies FROM User WHERE idUser =: idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result['nbFunnies'];
}

/**
 * Update the number of funnies of a user.
 * @param $idUser : ID of the user to update.
 * @param $newFunniesBalance : new number of funnies for the user.
 * @return int : an error code if an error occurred, else nothing.
 */
function updateUserFunnies($idUser, $newFunniesBalance) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE User SET nbFunnies = :nbFunnies WHERE idUser = :idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
			'nbFunnies' => $newFunniesBalance
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Search users by login.
 * @param $login : login to search.
 * @return int|mixed : all information about all user found, or an error code if an error occurred.
 */
function searchUser($login) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM User WHERE login =: login LIKE '%" . $login . "%'");

	try {
		$stmt->execute(array(
			'login' => $login,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}
