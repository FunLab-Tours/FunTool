<?php

/**
 * List all projects.
 * @return bool : all attributes from all projects, or an error code if an error occurred.
 */
function listAllProject() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Project");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Add a project.
 * @param $projectTitle : title of the project.
 * @param $projectWiki : description for the wiki of the project.
 * @param $dateProject : date of the project.
 * @return int : return an error code if an error occurred.
 */
function addProject($projectTitle, $projectWiki, $dateProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO Project(title, wiki, dateProject) VALUES (:title, :wiki, :dateProject)");

	try {
		$stmt->execute(array(
			'title' => $projectTitle,
			'wiki' => $projectWiki,
			'dateProject' => $dateProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get all information of a project.
 * @param $idProject : ID of the project to get.
 * @return bool : all attributes of the project or an error code if an error occurred.
 */
function selectProject($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM Project WHERE idProject=:idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetchAll();

	return $result;
}

/**
 * Edit a project.
 * @param $idProject : ID of the project to edit.
 * @param $projectTitle : new title for the project.
 * @param $projectWiki : new description for the wiki of the project.
 * @param $dateProject : new date for the project.
 * @return int : return an error code if an error occurred.
 */
function updateProject($idProject, $projectTitle, $projectWiki, $dateProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE Project SET title = :title, wiki = :wiki, dateProject = :dateProject WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject,
			'title' => $projectTitle,
			'wiki' => $projectWiki,
			'dateProject' => $dateProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a project.
 * @param $idProject : ID of the project to delete.
 * @return int : return an error code if an error occurred.
 */
function deleteProject($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM Project WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete all pictures of a project.
 * @param $idProject : ID of the project to act.
 * @return int : return an error code if an error occurred.
 */
function deletePictureLinkToProject($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM Picture WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Select all categories of projects.
 * @return int : return an error code if an error occurred.
 */
function selectAllProjectCategory() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM ProjectCategory");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Add a picture to a project.
 * @param $picture : picture to add.
 * @param $idProject : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function addPictureProject($picture, $idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO Picture(picture, idProject) VALUES(:picture, :idProject)");

	try {
		$stmt->execute(array(
			'picture' => $picture,
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get the ID of the last inserted project.
 * @return bool : ID of the last inserted project or an error code if an error occurred.
 */
function lastInsertProjectId() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT max(idProject) FROM Project");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $request->fetch()['max(idProject)'];

	return $result;
}

/**
 * Select all pictures of a project.
 * @param $idProject : ID of the project.
 * @return bool : array of pictures or an error code if an error occurred.
 */
function selectProjectPicture($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT picture FROM Picture WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch()['picture'];

	return $result;
}

/**
 * Get the good registering button for a project.
 * @param $idProject : ID of the project.
 * @param $alreadyRegistered : true if the user is already registered, else false.
 * @return string : HTML code of the button.
 */
function showRegisterButtonProject($idProject, $alreadyRegistered) {
	global $lang;

	// TODO : check return.
	if($alreadyRegistered)
		return "<a href=\"index.php?page=project&idUnregister=$idProject\" class=\"button\">" . $lang["unregister"] . "</a>"; // TODO : check links and make it more flexible.
	else
		return "<a href=\"index.php?page=project&idRegister=$idProject\" class=\"button\">" . $lang["register"] . "</a>";
}

/**
 * Check if a user is register to a project.
 * @param $idProject : ID of the project.
 * @param $idUser : ID of the user
 * @return bool : true if the user is registered, else false.
 */
function alreadyRegisteredProject($idProject, $idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(idUser) as nb_entry FROM participate WHERE idProject = :idProject AND idUser= :idUser");

	try {
		$request->execute(array(
			'idProject' => $idProject,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	if($request->fetch()['nb_entry'] == 0)
		return false;
	return true;
}

/**
 * Add a category of projects.
 * @param $title : title of the category.
 * @param $longCategoryLabel : long label for the category.
 * @return int : return an error code if an error occurred.
 */
function addProjectCategory($title, $longCategoryLabel) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO ProjectCategory(title,shortCategoryLabel,longCategoryLabel) VALUES(:title, :shortCategoryLabel, :longCategoryLabel)");

	$shortCategoryLabel = "";

	try {
		$stmt->execute(array(
			'title' => $title,
			'shortCategoryLabel' => $shortCategoryLabel,
			'longCategoryLabel' => $longCategoryLabel
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get all project categories.
 * @return mixed : all attributes of all project categories.
 */
function listAllProjectCategory() {
	global $DB_DB;
	$result = $DB_DB->query("SELECT * FROM ProjectCategory");

	return $result;
}

/**
 * Add a project into a category.
 * @param $idProCat : ID of the category.
 * @param $idProject : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function linkToProjectCategory($idProCat, $idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO isIncludeIn(idProCat,idProject) VALUES(:idProCat, :idProject)");

	try {
		$stmt->execute(array(
			'idProCat' => $idProCat,
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a project from a categories.
 * @param $idProject : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function deleteProjectIncludeIn($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM isIncludeIn WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Select a project into a category.
 * @param $idProject : ID of the project.
 * @return bool : all attributes of the project or an error code if an error occurred.
 */
function selectProjectInIsIncludeIn($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM isIncludeIn WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Select a project category.
 * @param $idProCat : ID of the project category.
 * @return bool : all attributes of the project category or an error code if an error occurred.
 */
function selectSpecificProjectCategory($idProCat) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM ProjectCategory WHERE idProCat = :idProCat");

	try {
		$stmt->execute(array(
			'idProCat' => $idProCat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Add a participant to a project.
 * @param $idUser : ID of the user.
 * @param $idProject : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function addParticipantToProject($idUser, $idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO participate(idUser, idProject) VALUES(:idUser, :idProject)");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Select all participants to a project.
 * @param $idProject : ID of the project.
 * @return bool : all attributes of all participants or an error code if an error occurred.
 */
function selectParticipantsToProject($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM participate WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Get all information from a user.
 * @param $idUser : ID of the user.
 * @return bool : all attributes of the user or an error code if an error occurred.
 */
function selectUser($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM User WHERE idUser = :idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Delete all participants of a project.
 * @param $idProject : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function deleteProjectParticipate($idProject) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM participate WHERE idProject = :idProject");

	try {
		$stmt->execute(array(
			'idProject' => $idProject
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a project from a category.
 * @param $idProCat : ID of the project.
 * @return int : return an error code if an error occurred.
 */
function deleteProjectCategoryIncludeIn($idProCat) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM isIncludeIn WHERE idProCat = :idProCat");

	try {
		$stmt->execute(array(
			'idProCat' => $idProCat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a category of projects.
 * @param $idProCat : ID of category.
 * @return int : return an error code if an error occurred.
 */
function deleteProjectCategory($idProCat) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM ProjectCategory WHERE idProCat = :idProCat");

	try {
		$stmt->execute(array(
			'idProCat' => $idProCat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Edit a project category.
 * @param $idProCat : ID of the category to edit.
 * @param $title : new title for the category.
 * @param $longCategoryLabel : new long label for the category.
 * @return int : return an error code if an error occurred.
 */
function updateProjectCategory($idProCat, $title, $longCategoryLabel) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE ProjectCategory SET title = :title, longCategoryLabel = :longCategoryLabel WHERE idProCat = :idProCat");

	try {
		$stmt->execute(array(
			'title' => $title,
			'longCategoryLabel' => $longCategoryLabel,
			'idProCat' => $idProCat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}
