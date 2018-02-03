<?php

/**
 * List all knowledge of a specific user.
 * @param $idUser : ID of the user to list.
 * @return mixed : list of knowledge with all attributes.
 */
function listKnowledge($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM know WHERE idUser = :id");

	try {
		$request->execute(array(
			'id' => $idUser
		));
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}

/**
 * List all knowledge of a specific user with ID of software.
 * @param $idUser : ID of the user to list.
 * @return mixed : ID list of knowledge.
 */
function listIdSoftwareFromKnowledge($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT idSoftware FROM know WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}

/**
 * Assign a knowledge to a user.
 * @param $idUser : ID of the user to add the knowledge.
 * @param $idSoftware : ID of the software to add.
 * @param $level : level of knowledge.
 * @param $comment : commentary about the knowledge.
 * @return bool : return true if the knowledge has been added, false else.
 */
function assignKnowledge($idUser, $idSoftware, $level, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO know (idUser, idSoftware, knowledgeLevel, comment) VALUES (:idUser, :idSoftware, :level, :comment)");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idSoftware' => $idSoftware,
			'level' => $level,
			'comment' => $comment
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Edit a knowledge for a user.
 * @param $idUser : ID of the user to modify.
 * @param $idSoft : ID of the software to modify.
 * @param $level : new knowledge level.
 * @param $comment : commentary about the knowledge.
 * @return bool : return true if the knowledge has been modified, false else.
 */
function editKnowledge($idUser, $idSoft, $level, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE know SET knowledgeLevel = :level, comment = :comment WHERE idSoftware = :idSoft AND idUser = :idUser");

	try {
		$request->execute(array(
			'idSoft' => $idSoft,
			'idUser' => $idUser,
			'level' => $level,
			'comment' => $comment
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Delete a knowledge from the database.
 * @param $idSoftware : ID of the software of the knowledge to delete.
 */
function unassignKnowledge($idSoftware) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM know WHERE idSoftware = :idSoftware");

	try {
		$request->execute(array(
			'idSoftware' => $idSoftware
		));
	}
	catch(Exception $e) {
	}
}
