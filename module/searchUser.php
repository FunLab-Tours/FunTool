<?php

// TODO : documentation and correct it ?
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
		return false;
	}

	return $request->fetchAll();
}

// TODO : documentation and correct it ?
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
				return false;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}

// TODO : documentation and correct it ?
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
				return false;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}

// TODO : documentation and correct it ?
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
				return false;
			}

			array_push($result, $request->fetchAll());
		}

	return $result[0];
}
