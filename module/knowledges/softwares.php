<?php

/*
 * Software.
 */

// TODO : documentation.
function testSoftware($id, $name) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM Software WHERE softwareName LIKE :name");

		try {
			$request->execute(array(
				'name' => $name
			));
		}
		catch(Exception $e) {
		}
		if($request->rowCount() != 0)
			return false;
		return true;
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
		}
		if($request->rowCount() != 0)
			return false;
		return true;
	}
}

/**
 * List all software.
 * @return mixed : all software with all attributes.
 */
function listSoftware() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Software");

	try {
		$request->execute();
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}

/**
 * Get all attributes of a specific software.
 * @param $id : ID of the software to get.
 * @return mixed : all attributes of a specific software.
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
	}

	return $request->fetchAll()[0];
}

/**
 * Add a software.
 * @param $name : name of the software.
 * @param $description : description of the software.
 * @param $categories : list of categories to add.
 * @param $subCategories : list of subcategories to add.
 * @return bool : return true if the software has been added, false else.
 */
function addSoftware($name, $description, $categories, $subCategories) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Software (SoftwareName, softwareDescription) VALUES (:name, :description)");

	if(!testSoftware(null, $name))
		return false;

	try {
		$request->execute(array(
			'name' => $name,
			'description' => $description
		));
	}
	catch(Exception $e) {
		return false;
	}

	$id = $DB_DB->lastInsertId();
	assignCategoriesToSoftWare($id, $categories);
	assignSubCategoriesToSoftWare($id, $subCategories);

	return true;
}

/**
 * Edit a specific software.
 * @param $id : ID of the software to edit.
 * @param $name : new name of the software.
 * @param $description : new description of the software.
 * @param $categories : new categories of the software.
 * @param $subCategories : new subcategories of the software.
 * @return bool : return true if the software has been modified, false else.
 */
function editSoftware($id, $name, $description, $categories, $subCategories) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Software SET SoftwareName = :name, softwareDescription = :description WHERE idSoftware = :id");

	if(!testSoftware($id, $name))
		return false;

	try {
		$request->execute(array(
			'id' => $id,
			'name' => $name,
			'description' => $description
		));
	}
	catch(Exception $e) {
		return false;
	}

	assignCategoriesToSoftWare($id, $categories);
	assignSubCategoriesToSoftWare($id, $subCategories);

	return true;
}

/**
 * Delete a software.
 * @param $id : ID of the software to delete.
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
	}

	$request = $DB_DB->prepare("DELETE FROM SoftwareInCategory WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
	}

	$request = $DB_DB->prepare("DELETE FROM SoftwareInSubCategory WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
	}

	$request = $DB_DB->prepare("DELETE FROM software WHERE  idSoftware = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
	}
}


/*
 * Software in category.
 */

/**
 * Get the categories of a software.
 * @param $id : ID of the software to check.
 * @return mixed : all categories with all attributes found.
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
	}

	return $request->fetchAll();
}

/**
 * Add multiple categories to a software.
 * @param $idSoftware : ID of the software.
 * @param $categories : categories to add.
 * @return bool : true if all categories has been added, false else.
 */
function assignCategoriesToSoftWare($idSoftware, $categories) {
	global $DB_DB;

	// First, we delete old links from SoftwareInCategory.
	unassignCategoriesFromSoftWare($idSoftware);

	// And then we set the new ones.
	foreach($categories as $category) {
		$request = $DB_DB->prepare('INSERT INTO SoftwareInCategory (idSoftware, idSoftCat) VALUES (:idSoftware, :idSoftCat)');
		try {
			$request->execute(array(
				'idSoftware' => $idSoftware,
				'idSoftCat' => $category
			));
		}
		catch(Exception $e) {
			return false;
		}
	}
}

/**
 * Delete all categories of a software.
 * @param $idSoftware : ID of the software to edit.
 * @return bool : return true if all software have been deleted, false else.
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
		return false;
	}
}


/*
 * Software in subcategory.
 */

/**
 * Get all subcategories of a software.
 * @param $id : ID of the software.
 * @return mixed : all subcategories with all attributes.
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
	}

	return $request->fetchAll();
}

/**
 * Add many subcategories to a software.
 * @param $idSoftware : ID of the software.
 * @param $subCategories : list of subcategories to add.
 * @return bool : return true if subcategories have been added, false else.
 */
function assignSubCategoriesToSoftWare($idSoftware, $subCategories) {
	global $DB_DB;

	// First we delete old links from SoftwareInSubCategory.
	unassignSubCategoriesFromSoftWare($idSoftware);

	// And then we add new ones.
	foreach($subCategories as $subCategory) {
		$request = $DB_DB->prepare('INSERT INTO SoftwareInSubCategory (idSoftware, idSoftSubcat) VALUES (:idSoftware, :idSoftSubcat)');
		try {
			$request->execute(array(
				'idSoftware' => $idSoftware,
				'idSoftSubcat' => $subCategory
			));
		}
		catch(Exception $e) {
			return false;
		}
	}
}

/**
 * Delete all subcategories of a software.
 * @param $idSoftware : ID of the software.
 * @return bool : true if all subcategories have been deleted, false else.
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
		return false;
	}
}
