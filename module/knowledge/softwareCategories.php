<?php

/*
 *  Categories.
 */


/**
 * Check if a software category already exists or not.
 * @param $id : ID of the software (can be null).
 * @param $code : code of the software.
 * @param $label : label of the software.
 * @return bool|int : true if the software category already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsSoftwareCategory($id, $code, $label) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE categoryCode = :code OR categoryLabel LIKE :label");

		try {
			$request->execute(array(
				'code' => $code,
				'label' => $label
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE idSoftCat <> :id AND (categoryCode LIKE :code OR categoryLabel LIKE :label)");

		try {
			$request->execute(array(
				'id' => $id,
				'code' => $code,
				'label' => $label
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
 * List all software categories.
 * @return int : all data from all categories, or error code if an error occurred.
 */
function listSoftwareCategories() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftWareCategory");

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
 * Get a specific category of software.
 * @param $id : ID of the category to get.
 * @return mixed : entire category with all of this attributes, or error code if an error occurred.
 */
function getSoftwareCategory($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftWareCategory WHERE idsoftcat = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll()[0];
}

/**
 * Add a new software category.
 * @param $code : code of the category to add.
 * @param $label : label of the category.
 * @return bool : return error code if an error occurred.
 */
function addSoftwareCategory($code, $label) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SoftwareCategory  (categoryCode, categoryLabel) VALUES (:code, :label)');

	if(!alreadyExistsSoftwareCategory(null, $code, $label))
		return -3;

	try {
		$request->execute(array(
			'code' => $code,
			'label' => $label
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
 * Edit a category.
 * @param $id : ID of the software category to edit.
 * @param $code : new code of the software category.
 * @param $label : new label of the software category.
 * @return bool : return error code if an error occurred.
 */
function editSoftwareCategory($id, $code, $label) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE SoftwareCategory SET categoryCode = :code, categoryLabel = :label WHERE idSoftCat = :id');

	if(!alreadyExistsSoftwareCategory($id, $code, $label))
		return -3;

	try {
		$request->execute(array(
			'id' => $id,
			'code' => $code,
			'label' => $label
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
 * Delete a software category.
 * @param $id : ID of the software category to delete.
 * @return bool : return error code if an error occurred.
 */
function deleteSoftwareCategory($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM softwareInCategory WHERE  idSoftcat = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$request = $DB_DB->prepare("DELETE FROM softwareCategory WHERE idSoftcat = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}


/*
 * Subcategories.
 */

/**
 * Check if a software subcategory already exists or not.
 * @param $id : ID of the subcategory (can be null).
 * @param $code : code of the subcategory.
 * @param $label : label of the subcategory.
 * @return bool|int : true if the software subcategory already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsSoftwareSubCategory($id, $code, $label) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE SubcatCode LIKE :code OR SubcatLabel LIKE :label");

		try {
			$request->execute(array(
				'code' => $code,
				'label' => $label
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE idSoftSubcat <> :id AND (SubcatCode LIKE :code OR SubcatLabel LIKE :label)");

		try {
			$request->execute(array(
				'code' => $code,
				'label' => $label,
				'id' => $id
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
 * List all subcategories of software for a specific category.
 * @param $idCategory : category to check.
 * @return mixed : all attributes of all subcategories found, or error code if an error occurred.
 */
function listSoftwareSubCategories($idCategory) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftWareSubCategory WHERE idSoftCat = :idCategory");

	try {
		$request->execute(array(
			'idCategory' => $idCategory
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
 * Get a specific software subcategory.
 * @param $id : id of the subcategory to get.
 * @return mixed : all attributes of the software category selected, or error code if an error occurred.
 */
function getSoftwareSubCategory($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftWareSubCategory WHERE idsoftsubcat = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll()[0];
}

/**
 * Add a software subcategory.
 * @param $idCat : category of the subcategory.
 * @param $code : code of the subcategory.
 * @param $label : label of the subcategory.
 * @return int : return error code if an error occurred.
 */
function addSoftwareSubCategory($idCat, $code, $label) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SoftwareSubcategory  (idSoftCat, SubcatCode, SubcatLabel)  VALUES (:idCat, :code, :label)');

	if(!alreadyExistsSoftwareSubCategory(null, $code, $label))
		return -3;

	try {
		$request->execute(array(
			'idCat' => $idCat,
			'code' => $code,
			'label' => $label
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
 * Edit a subcategory of software.
 * @param $id : ID of the subcategory to edit.
 * @param $code : new code of the subcategory.
 * @param $label : new label of the subcategory.
 * @return int : return error code if an error occurred.
 */
function editSoftwareSubCategory($id, $code, $label) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE SoftwareSubcategory SET SubcatCode = :code, SubcatLabel = :label WHERE idSoftSubcat = :id');

	if(!alreadyExistsSoftwareSubCategory($id, $code, $label))
		return -3;

	try {
		$request->execute(array(
			'id' => $id,
			'code' => $code,
			'label' => $label
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
 * Delete a subcategory.
 * @param $id : ID of the subcategory to delete.
 * @return int : return error code if an error occurred.
 */
function deleteSubCategory($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM softwareInSubCategory WHERE  idSoftSubcat = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$request = $DB_DB->prepare('DELETE FROM softwaresubcategory WHERE idSoftSubcat = :id');

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}
