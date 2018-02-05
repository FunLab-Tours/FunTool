<?php

/**
 * Find users who their name or login contain the given argument.
 * @param $pattern : the name to search.
 * @return mixed : the map list of all users found, or an error code if an error occurred.
 */
function searchForUser($pattern) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE (firstName LIKE :pattern OR name LIKE :pattern OR login LIKE :pattern) AND idUser <> :id");

	try {
		$request->execute(array(
			'id' => $_COOKIE['id'],
			'pattern' => $pattern
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
 * Find all user with given roles.
 * @param $roles : an array of roles.
 * @return mixed : the map list of all users found, or an error code if an error occurred.
 */
function searchForRoles($roles) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (SELECT idUser FROM userRole WHERE idRole = :role) ORDER BY login");

	$result = array();

	foreach($roles as $role)
		if($role != "") {
			try {
				$request->execute(array(
					'role' => $role
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}

/**
 * Find all user with given skills.
 * @param $skills : an array of skills.
 * @return mixed : the map list of all users found, or an error code if an error occurred.
 */
function searchForSkills($skills) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (SELECT idUser FROM has WHERE idSkill = :skill ORDER BY skillLevel)");

	$result = array();

	foreach($skills as $skill)
		if($skill != "") {
			try {
				$request->execute(array(
					'skill' => $skill
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}

/**
 * Find all user with given knowledge.
 * @param $knowledge : an array of knowledge.
 * @return mixed : the map list of all users found, or an error code if an error occurred.
 */
function searchForKnowledge($knowledge) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (SELECT idUser FROM know WHERE idsoftware = :current_knowledge ORDER BY knowledgeLevel)");

	$result = array();

	foreach($knowledge as $current_knowledge)
		if($current_knowledge != "") {
			try {
				$request->execute(array(
					'current_knowledge' => $current_knowledge
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}
