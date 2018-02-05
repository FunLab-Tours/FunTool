<?php

/*
 * Software.
 */

/**
 * Check if a software already exits or not.
 * @param $id : ID of the software (can be null).
 * @param $name : name of the software.
 * @return bool|int : true if the software already exists, false else, or an error code if an error occurred.
 */
function alreadyExistsSoftware($id, $name) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM Software WHERE softwareName LIKE :name");

		try {
			$request->execute(array(
				'name' => $name
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM Software WHERE idSoftware <> :id AND softwareName LIKE :name");

		try {
			$request->execute(array(
				'id' => $id,
				'name' => $name
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}

	if($request->rowCount() != 0)
		return false;
	return true;
}

/**
 * List all software.
 * @return mixed : all software with all attributes, or error code if an error occurred.
 */
function listSoftware() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Software");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get all attributes of a specific software.
 * @param $id : ID of the software to get.
 * @return mixed : all attributes of a specific software, or error code if an error occurred.
 */
function getSoftWare($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Software WHERE idsoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll()[0];
}

/**
 * Add a software.
 * @param $name : name of the software.
 * @param $description : description of the software.
 * @param $categories : list of categories to add.
 * @param $subCategories : list of subcategories to add.
 * @return bool : return error code if an error occurred.
 */
function addSoftware($name, $description, $categories, $subCategories) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Software (SoftwareName, softwareDescription) VALUES (:name, :description)");

	if(!alreadyExistsSoftware(null, $name))
		return -3;

	try {
		$request->execute(array(
			'name' => $name,
			'description' => $description
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$id = $DB_DB->lastInsertId();
	assignCategoriesToSoftWare($id, $categories);
	assignSubCategoriesToSoftWare($id, $subCategories);

	return "";
}

/**
 * Edit a specific software.
 * @param $id : ID of the software to edit.
 * @param $name : new name of the software.
 * @param $description : new description of the software.
 * @param $categories : new categories of the software.
 * @param $subCategories : new subcategories of the software.
 * @return int : return error code if an error occurred.
 */
function editSoftware($id, $name, $description, $categories, $subCategories) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Software SET SoftwareName = :name, softwareDescription = :description WHERE idSoftware = :id");

	if(!alreadyExistsSoftware($id, $name))
		return -3;

	try {
		$request->execute(array(
			'id' => $id,
			'name' => $name,
			'description' => $description
		));
	}
	catch(Exception $e) {
		return -2;
	}

	assignCategoriesToSoftWare($id, $categories);
	assignSubCategoriesToSoftWare($id, $subCategories);

	return "";
}

/**
 * Delete a software.
 * @param $id : ID of the software to delete.
 * @return int : return error code if an error occurred.
 */
function deleteSoftware($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM know WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$request = $DB_DB->prepare("DELETE FROM SoftwareInCategory WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$request = $DB_DB->prepare("DELETE FROM SoftwareInSubCategory WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$request = $DB_DB->prepare("DELETE FROM software WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}


/*
 * Software in category.
 */

/**
 * Get the categories of a software.
 * @param $id : ID of the software to check.
 * @return mixed : all categories with all attributes found, or error code if an error occurred.
 */
function getSoftwareCategories($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE idSoftCat IN (SELECT idSoftCat FROM SoftwareInCategory WHERE idSoftWare = :id)");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Add multiple categories to a software.
 * @param $idSoftware : ID of the software.
 * @param $categories : categories to add.
 * @return bool : return error code if an error occurred.
 */
function assignCategoriesToSoftWare($idSoftware, $categories) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SoftwareInCategory (idSoftware, idSoftCat) VALUES (:idSoftware, :idSoftCat)');

	// First, we delete old links from SoftwareInCategory.
	unassignCategoriesFromSoftWare($idSoftware);

	// And then we set the new ones.
	foreach($categories as $category) {
		try {
			$request->execute(array(
				'idSoftware' => $idSoftware,
				'idSoftCat' => $category
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}
}

/**
 * Delete all categories of a software.
 * @param $idSoftware : ID of the software to edit.
 * @return bool : return error code if an error occurred.
 */
function unassignCategoriesFromSoftWare($idSoftware) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM SoftwareInCategory WHERE idSoftware = :id');

	try {
		$request->execute(array(
			'id' => $idSoftware
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}


/*
 * Software in subcategory.
 */

/**
 * Get all subcategories of a software.
 * @param $id : ID of the software.
 * @return mixed : all subcategories with all attributes, or error code if an error occurred.
 */
function getSoftwareSubCategories($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE idSoftSubcat IN (SELECT idSoftSubcat FROM SoftwareInSubCategory WHERE idSoftWare = :id)");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Add many subcategories to a software.
 * @param $idSoftware : ID of the software.
 * @param $subCategories : list of subcategories to add.
 * @return bool : return error code if an error occurred.
 */
function assignSubCategoriesToSoftWare($idSoftware, $subCategories) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO SoftwareInSubCategory (idSoftware, idSoftSubcat) VALUES (:idSoftware, :idSoftSubcat)');

	// First we delete old links from SoftwareInSubCategory.
	unassignSubCategoriesFromSoftWare($idSoftware);

	// And then we add new ones.
	foreach($subCategories as $subCategory) {
		try {
			$request->execute(array(
				'idSoftware' => $idSoftware,
				'idSoftSubcat' => $subCategory
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}

	return "";
}

/**
 * Delete all subcategories of a software.
 * @param $idSoftware : ID of the software.
 * @return bool : return error code if an error occurred.
 */
function unassignSubCategoriesFromSoftWare($idSoftware) {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM SoftwareInSubCategory WHERE idSoftware = :id');

	try {
		$request->execute(array(
			'id' => $idSoftware
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}
