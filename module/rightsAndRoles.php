<?php

// User.

/**
 * Assign roles to a user.
 * @param $idUser : ID of the user.
 * @param $idsRoles : array of IDs of the roles.
 * @return int : return an error code if an error occurred.
 */
function assignRolesToUser($idUser, $idsRoles) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM userRole WHERE idUser = :id');

	// We delete old ones and set new ones.

	try {
		$request->execute(array(
			'id' => $idUser,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	foreach($idsRoles as $idRole) {
		$request = $DB_DB->prepare('INSERT INTO userRole (idRole, idUser) VALUES (:idRole, :idUser)');

		try {
			$request->execute(array(
				'idUser' => $idUser,
				'idRole' => $idRole
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}

	return "";
}

// Roles.

/**
 * Check if a role already exists or not.
 * @param $id : ID of the role (can be null).
 * @param $name : name of the role.
 * @return bool|int : true if the role already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsRole($id, $name) {
	global $DB_DB;

	if($id == null) {
		try {
			$request = $DB_DB->prepare("SELECT * FROM Role WHERE roleName LIKE :name");

			$request->execute(array(
				'name' => $name
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}
	else {
		try {
			$request = $DB_DB->prepare("SELECT * FROM Role WHERE roleName LIKE :name AND idRole <> :id");

			$request->execute(array(
				'id' => $id,
				'name' => $name
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * Get all roles of a user.
 * @param $idUser : ID of the user.
 * @return bool : list of roles or an error code if an error occurred.
 */
function getUserRoles($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Role WHERE idRole IN (SELECT idRole FROM userRole WHERE idUser = :idUser)");

	try {
		$request->execute(array(
			'idUser' => $idUser
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
 * Get the list of all roles.
 * @return bool : list of roles or an error code if an error occurred.
 */
function getRolesList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Role");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Add a role.
 * @param $name : name of the role.
 * @param $description : description of the role.
 * @param $rights : rights of the role.
 * @return int : return an error code if an error occurred.
 */
function addRole($name, $description, $rights) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Role (roleName, roleDescription) VALUES (:roleName, :roleDescription)');

	if(!alreadyExistsRole(null, $name))
		return -3;

	try {
		$request->execute(array(
			'roleName' => $name,
			'roleDescription' => $description
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$idRole = $DB_DB->lastInsertId();

	// Add links with rights.
	if($rights != null)
		foreach($rights as $right) {
			$request = $DB_DB->prepare('INSERT INTO according (idRole, idRights) VALUES (:idRole, :idRights)');

			try {
				$request->execute(array(
					'idRole' => $idRole,
					'idRights' => $right
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}
		}

	return "";
}

/**
 * Edit a role.
 * @param $idRole : ID of the role to edit.
 * @param $name : new name for the role.
 * @param $description : new description of the role.
 * @param $rights : new rights for the role.
 * @return int : return an error code if an error occurred.
 */
function editRole($idRole, $name, $description, $rights) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Role SET roleName = :roleName, roleDescription = :roleDescription WHERE idRole= :idRole');

	if(!alreadyExistsRole($idRole, $name))
		return false;

	try {
		$request->execute(array(
			'idRole' => $idRole,
			'roleName' => $name,
			'roleDescription' => $description
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	// For according relation we delete all and add new ones.
	try {
		$request = $DB_DB->prepare('DELETE FROM according WHERE idRole = :idRole');

		$request->execute(array(
			'idRole' => $idRole,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	// Add links with rights.
	if($rights != null)
		$request = $DB_DB->prepare('INSERT INTO according (idRole, idRights) VALUES (:idRole, :idRights)');

	foreach($rights as $right) {
		try {
			$request->execute(array(
				'idRole' => $idRole,
				'idRights' => $right
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}

	return "";
}

/**
 * Delete a role.
 * @param $idRole : ID of the role to delete.
 * @return int : return an error code if an error occurred.
 */
function deleteRole($idRole) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM according WHERE idRole = :idRole');

	// Delete the key in according.

	try {
		$request->execute(array(
			'idRole' => $idRole,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	// Delete the key in userRole.
	$request = $DB_DB->prepare('DELETE FROM userRole WHERE idRole = :idRole');

	try {
		$request->execute(array(
			'idRole' => $idRole,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	// Then delete the role.
	$request = $DB_DB->prepare('DELETE FROM Role WHERE idRole = :idRole');

	try {
		$request->execute(array(
			'idRole' => $idRole,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

// Rights.

/**
 * Check if a right already exists or not.
 * @param $id : ID of the right (can be null).
 * @param $title : title of the right.
 * @param $path : path used by the right.
 * @return bool|int : true if the right already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsRight($id, $title, $path) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsTitle LIKE :title");

	if($id == null) {
		try {
			$request->execute(array(
				'title' => $title
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}

		if($request->rowCount() != 0)
			return false;

		$request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsPath LIKE :path");

		try {
			$request->execute(array(
				'path' => $path
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}

		if($request->rowCount() != 0)
			return false;
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsTitle LIKE :title AND idRights <> :id");

		try {
			$request->execute(array(
				'id' => $id,
				'title' => $title
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}

		if($request->rowCount() != 0)
			return false;

		$request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsPath LIKE :path AND idRights <> :id");

		try {
			$request->execute(array(
				'id' => $id,
				'path' => $path
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}

		if($request->rowCount() != 0)
			return false;
	}

	return true;
}

/**
 * Get the rights of a role.
 * @param $idRole : ID of the role.
 * @return bool : list of rights or an error code if an error occurred.
 */
function getRights($idRole) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Rights WHERE idRights IN (SELECT idRights FROM according WHERE idRole = :idRole");

	try {
		$request->execute(array(
			'idRole' => $idRole
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
 * Get the list of all rights.
 * @return bool : list of rights or an error code if an error occurred.
 */
function getRightsList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Rights");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get rights used by a role.
 * @param $idRole : ID of the role.
 * @return bool : list of rights or an error code if an error occurred.
 */
function getRightsRoleList($idRole) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Rights WHERE idRights IN (SELECT idRights FROM according WHERE idRole = :idRole)");

	try {
		$request->execute(array(
			'idRole' => $idRole
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
 * Get the list of rights related with their roles.
 * @param $roles : roles to get.
 * @return array|int : list of rights and roles or an error code if an error occurred.
 */
function getRightsListWithRoles($roles) { // TODO : test this function.
	// Return the list of all rights attached to the list of roles passed in parameters. Doesn't count double rights.
	$list = array();

	foreach($roles as $role) {
		$rights = getRightsRoleList($role['idRole']);

		if(!$rights)
			return -2;

		foreach($rights as $right)
			if(!in_array($right, $list))
				array_push($list, $right);
	}

	return $list;
}

/**
 * Add a right.
 * @param $title : title of the right.
 * @param $description : description of the right.
 * @param $path : path of the file used by the right.
 * @return int : return an error code if an error occurred.
 */
function addRight($title, $description, $path) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Rights(rightsTitle, rightsDescription, rightsPath) VALUES(:rightsTitle, :rightsDescription, :rightsPath)');

	if(!alreadyExistsRight(null, $title, $path))
		return -3;

	try {
		$request->execute(array(
			'rightsTitle' => $title,
			'rightsDescription' => $description,
			'rightsPath' => $path
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
 * Edit a right.
 * @param $idRight : ID of the right to edit.
 * @param $title : new title for the right.
 * @param $description : new description for the right.
 * @param $path : new path for the file used by the right.
 * @return int : return an error code if an error occurred.
 */
function editRight($idRight, $title, $description, $path) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Rights SET rightsTitle = :rightsTitle, rightsDescription = :rightsDescription, rightsPath = :rightsPath WHERE idRights = :idRight');

	if(!alreadyExistsRight($idRight, $title, $path))
		return -3;

	try {
		$request->execute(array(
			'idRight' => $idRight,
			'rightsTitle' => $title,
			'rightsDescription' => $description,
			'rightsPath' => $path
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
 * Delete a right.
 * @param $idRight : ID of the right to delete.
 * @return int : return an error code if an error occurred.
 */
function deleteRight($idRight) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM according WHERE idRights = :idRight');

	// We delete the key in according.

	try {
		$request->execute(array(
			'idRight' => $idRight,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$request = $DB_DB->prepare('DELETE FROM Rights WHERE idRights = :idRight');

	try {
		$request->execute(array(
			'idRight' => $idRight,
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}
