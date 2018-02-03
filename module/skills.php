<?php

// Skills to user.

/**
 * Check if a user has a particular skill.
 * @param $idSkill : ID of the skill to check.
 * @param $idUser : ID of the user to check.
 * @return bool : true if the user has the skill, else false.
 */
function isUserSkilled($idSkill, $idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM has WHERE idUser = :idUser AND idSkill = :idSkill");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idSkill' => $idSkill
		));
	}
	catch(Exception $e) {
		return false; // TODO : change catch.
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * Assign a skill to a user.
 * @param $idUser : ID of the user.
 * @param $idSkill : ID of the skill.
 * @param $skillLevel : skill level.
 * @param $comment : comment about the skill.
 * @return bool : true if the skill has been added, false else.
 */
function assignSkills($idUser, $idSkill, $skillLevel, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO has(idUser, idSkill, skillLevel, comment) VALUES(:idUser, :idSkill, :skillLevel, :comment)');

	if(!in_array(getSkill($idSkill), getSkillsListUser($idUser))) {
		try {
			$request->execute(array(
				'idUser' => $idUser,
				'idSkill' => $idSkill,
				'skillLevel' => $skillLevel,
				'comment' => $comment
			));
		}
		catch(Exception $e) {
			return false;
		}

		return true;
	}

	return false;
}

/**
 * Suppress a skill for a user.
 * @param $idUser : ID of the user.
 * @param $idSkill : ID of the skill.
 * @return bool : false if an error occurred.
 */
function unassignSkill($idUser, $idSkill) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM has WHERE idUser = :idUser AND idSkill = :idSkill");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idSkill' => $idSkill
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Get all information about the skill of a user.
 * @param $idUser : ID of the user.
 * @param $idSkill : ID of the skill.
 * @return bool : all attributes of the skill or false if an error occurred.
 */
function getSkillUserInformation($idUser, $idSkill) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM has WHERE idUser = :idUser AND idSkill = :idSkill");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idSkill' => $idSkill
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll()[0];
}

/**
 * Edit a skill assigned to a user.
 * @param $idUser : ID of the user.
 * @param $idSkill : ID of the skill.
 * @param $skillLevel : new level for the skill.
 * @param $comment : new comment for the skill.
 * @return bool : false if an error occurred.
 */
function editAssignment($idUser, $idSkill, $skillLevel, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE has SET skillLevel = :skillLevel, comment = :comment WHERE idUser = :idUser AND idSkill = :idSkill');

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idSkill' => $idSkill,
			'skillLevel' => $skillLevel,
			'comment' => $comment
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

// Skills.

// TODO : documentation test.
function testSkill($idSkill, $skillName, $idSkillType) {
	global $DB_DB;

	if($idSkill == null) {
		$request = $DB_DB->prepare("SELECT * FROM variousskills WHERE skillName LIKE :skillName");

		try {
			$request->execute(array(
				'skillName' => $skillName
			));
		}
		catch(Exception $e) {
			return false;
		}

		if($request->rowCount() != 0)
			return false;
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM variousskills WHERE skillName LIKE :skillName AND idSkill <> :idSkill");

		try {
			$request->execute(array(
				'skillName' => $skillName,
				'idSkill' => $idSkill
			));
		}
		catch(Exception $e) {
			return false;
		}

		if($request->rowCount() != 0)
			return false;
	}

	$request = $DB_DB->prepare("SELECT * FROM SkillType WHERE idSkillType LIKE :idSkillType");

	try {
		$request->execute(array(
			'idSkillType' => $idSkillType
		));
	}
	catch(Exception $e) {
		return false;
	}

	if($request->rowCount() == 0)
		return false;

	return true;
}

/**
 * Get the list of all skills.
 * @return bool : all attributes of all skills or false if an error occurred.
 */
function getSkillsList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM VariousSkills");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Get all information about a specific skill.
 * @param $idSkill : ID of the skill.
 * @return bool : all information about the skill or false if an error occurred.
 */
function getSkill($idSkill) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM VariousSkills WHERE idSkill = :idSkill");

	try {
		$request->execute(array(
			'idSkill' => $idSkill
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Get all skills of a specific user.
 * @param $idUser : ID of the user.
 * @return bool : list of skills or false if an error occurred.
 */
function getSkillsListUser($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM VariousSkills WHERE idSkill IN (SELECT idSkill FROM has WHERE idUser = :idUser)");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Add a skill.
 * @param $skillName : name of the skill.
 * @param $skillDescription : description of the skill.
 * @param $idSkillType : ID of the type of the skill.
 * @return bool : false if an error occurred.
 */
function addSkill($skillName, $skillDescription, $idSkillType) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO VariousSkills (skillName, skillDescription, idSkillType) VALUES (:skillName, :skillDescription, :idSkillType)");

	if(!testSkill(null, $skillName, $idSkillType))
		return false;

	try {
		$request->execute(array(
			'skillName' => $skillName,
			'skillDescription' => $skillDescription,
			'idSkillType' => $idSkillType
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Edit a skill.
 * @param $idSkill : ID of the skill to edit.
 * @param $skillName : new name for the skill.
 * @param $skillDescription : new description about the skill.
 * @param $idSkillType : new ID for the new type of skill.
 * @return bool : false if an error occurred.
 */
function editSkill($idSkill, $skillName, $skillDescription, $idSkillType) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE VariousSkills SET skillName = :skillName, skillDescription = :skillDescription, idSkillType = :idSkillType WHERE idSkill = :idSkill");

	if(!testSkill($idSkill, $skillName, $idSkillType))
		return false;

	try {
		$request->execute(array(
			'idSkill' => $idSkill,
			'skillName' => $skillName,
			'skillDescription' => $skillDescription,
			'idSkillType' => $idSkillType
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Delete a skill.
 * @param $idSkill : ID of the skill.
 * @return bool : false if an error occurred.
 */
function deleteSkill($idSkill) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM has WHERE idSkill = :idSkill");

	// Delete in table 'has'.

	try {
		$request->execute(array(
			'idSkill' => $idSkill,
		));
	}
	catch(Exception $e) {
		return false;
	}

	// Delete in table 'VariousSkills'.
	$request = $DB_DB->prepare("DELETE FROM VariousSkills WHERE idSkill = :idSkill");

	try {
		$request->execute(array(
			'idSkill' => $idSkill,
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

// Skill type.

// TODO : documentation test.
function testSkillType($idSkillType, $skillTypeName) {
	global $DB_DB;

	if($idSkillType == null) {
		$request = $DB_DB->prepare("SELECT * FROM SkillType WHERE skillTypeName LIKE :skillTypeName");

		try {
			$request->execute(array(
				'skillTypeName' => $skillTypeName
			));
		}
		catch(Exception $e) {
			return false;
		}

		if($request->rowCount() != 0)
			return false;
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM SkillType WHERE skillTypeName LIKE :skillTypeName AND idSkillType <> :idSkillType");

		try {
			$request->execute(array(
				'idSkillType' => $idSkillType,
				'skillTypeName' => $skillTypeName
			));
		}
		catch(Exception $e) {
			return false;
		}

		if($request->rowCount() != 0)
			return false;
	}

	return true;
}

/**
 * Get information about a skill type.
 * @param $idSkillType : ID of the skill type.
 * @return bool : all attributes of the skill or false if an error occurred.
 */
function getSkillType($idSkillType) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SkillType WHERE idSkillType = :idSkillType");

	try {
		$request->execute(array(
			'idSkillType' => $idSkillType
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll()[0];
}

/**
 * Get the list of all skill type.
 * @return bool : all attributes about all skill types or false if an error occurred.
 */
function getSkillsTypeList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SkillType");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Add a skill type.
 * @param $skillTypeName : name of the skill type.
 * @return bool : false if an error occurred.
 */
function addSkillType($skillTypeName) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO SkillType (skillTypeName) VALUES (:skillTypeName)");

	if(!testSkillType(null, $skillTypeName))
		return false;

	try {
		$request->execute(array(
			'skillTypeName' => $skillTypeName
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Edit a skill type.
 * @param $idSkillType : ID of the skill type.
 * @param $skillTypeName : new name for the skill.
 * @return bool : false if an error occurred.
 */
function editSkillType($idSkillType, $skillTypeName) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE SkillType SET skillTypeName = :skillTypeName WHERE idSkillType = :idSkillType");

	if(!testSkillType($idSkillType, $skillTypeName))
		return false;

	try {
		$request->execute(array(
			'idSkillType' => $idSkillType,
			'skillTypeName' => $skillTypeName
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Delete a skill type.
 * @param $idSkillType : ID of the skill.
 * @return bool : false if an error occurred.
 */
function deleteSkillType($idSkillType) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM SkillType WHERE idSkillType = :idSkillType");

	// The delete can be effective only if it is not use in a variousSkill.

	try {
		$request->execute(array(
			'idSkillType' => $idSkillType,
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}
