<?php

// Materials.

// TODO : documentation.
function testMaterial($id, $labelMat, $codeMat) {
	global $DB_DB;

	if($id == null) {
		$request = $DB_DB->prepare("SELECT * FROM Materials WHERE labelMat LIKE :labelMat OR codeMat LIKE :codeMat");

		$request->execute(array(
			'labelMat' => $labelMat,
			'codeMat' => $codeMat
		));

		$result = $request->fetchAll();
	}
	else {
		$request = $DB_DB->prepare("SELECT * FROM Materials WHERE (labelMat LIKE :labelMat OR codeMat LIKE :codeMat) AND idMat = :id");

		$request->execute(array(
			'labelMat' => $labelMat,
			'codeMat' => $codeMat,
			'id' => $id
		));

		$result = $request->fetchAll();
	}

	return empty($result);
}

/**
 * Add a material to the database.
 * @param $labelMat : label of the material.
 * @param $codeMat : code of the material.
 * @param $priceMat : price of the material.
 * @param $docLink : link to the documentation of the material.
 * @param $comment : comment about the material.
 * @return bool : ID of the material or an error code if an error occurred.
 */
function addMaterial($labelMat, $codeMat, $priceMat, $docLink, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Materials(labelMat, codeMat, priceMat, docLink, comment, dateEntry) VALUES (:labelMat, :codeMat, :priceMat, :docLink, :comment, :dateEntry)");

	if(!testMaterial(null, $labelMat, $codeMat))
		return -2;

	try {
		$request->execute(array(
			'labelMat' => $labelMat,
			'codeMat' => $codeMat,
			'priceMat' => $priceMat,
			'docLink' => $docLink,
			'comment' => $comment,
			'dateEntry' => date_create("now")->format("Y-m-d H:i:s")
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $DB_DB->lastInsertId();
}

/**
 * Get information about a material.
 * @param $idMaterial : ID of the material to get.
 * @return mixed : all attributes of the material or an error code if an error occurred.
 */
function getMaterial($idMaterial) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Materials WHERE idMat = :id");

	try {
		$request->execute(array(
			'id' => $idMaterial
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetch();
}

/**
 * List all materials.
 * @return int : list of all materials or an error code if an error occurred.
 */
function listMaterials() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Materials");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Delete a material.
 * @param $idMat : ID of the material to delete.
 * @return int : an error code if an error occurred.
 */
function deleteMaterial($idMat) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM Materials WHERE idMat = :idMat");

	try {
		$request->execute(array(
			'idMat' => $idMat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Edit a material.
 * @param $idMat : ID of the material to edit.
 * @param $labelMat : new label for the material.
 * @param $codeMat : new code for the material.
 * @param $priceMat : new price for the material.
 * @param $docLink : new link for the documentation of the material.
 * @param $comment : new comment about the material.
 * @return int : an error code if an error occurred.
 */
function editMaterial($idMat, $labelMat, $codeMat, $priceMat, $docLink, $comment) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Materials SET labelMat = :labelMat, codeMat = :codeMat, priceMat = :priceMat, docLink = :docLink, comment = :comment WHERE idMat = :idMat");

	if(!testMaterial($idMat, $labelMat, $codeMat))
		return -3;

	try {
		$request->execute(array(
			'labelMat' => $labelMat,
			'codeMat' => $codeMat,
			'priceMat' => $priceMat,
			'docLink' => $docLink,
			'comment' => $comment,
			'idMat' => $idMat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

// Cost unit.

/**
 * Get the cost price of a material.
 * @param $idMat : ID of the material to get the price.
 * @return int : price of the material or an error code if an error occurred.
 */
function getCostUnitMat($idMat) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM CostUnitMaterial WHERE idCostUnitMaterial IN (SELECT idCostUnitMaterial FROM Materials WHERE idMat = :idMat)");

	try {
		$request->execute(array(
			'idMat' => $idMat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetch();
}

/**
 * Assign a cost for a material.
 * @param $idMat : ID of the material.
 * @param $priceUnit : price of the material for one unit.
 * @param $unit : number of unit for the material.
 * @return int : an error code if an error occurred.
 */
function assignCostUnit($idMat, $priceUnit, $unit) {
	global $DB_DB;
	$request = $DB_DB->prepare('UPDATE Materials SET idCostUnitMaterial = :idCostUnitMaterial WHERE idMat = :idMat');

	$idCostUnit = getIdCostUnitMat($priceUnit, $unit);

	try {
		$request->execute(array(
			'idCostUnitMaterial' => $idCostUnit,
			'idMat' => $idMat
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get the cost of a unit material.
 * @param $priceUnit : price unit for the material.
 * @param $unit : number of unit of the material.
 * @return int : ID of the cost unit or an error code if an error occurred.
 */
function getIdCostUnitMat($priceUnit, $unit) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT idCostUnitMaterial FROM CostUnitMaterial WHERE costUnit LIKE :costUnit AND unit LIKE :unit');

	// We check if the price exists, if yes we get the ID, else we create it and we get the ID.

	try {
		$request->execute(array(
			'costUnit' => $priceUnit,
			'unit' => $unit
		));
	}
	catch(Exception $e) {
		return -2;
	}

	if($request->rowCount() == 0)
		return addCostUnitMaterial($priceUnit, $unit);
	else
		return $request->fetch()[0];
}

/**
 * Add a cost unit for a material.
 * @param $priceUnit : price for one unit of material.
 * @param $unit : number of unit of the material.
 * @return int : ID of the cost unit or an error code if an error occurred.
 */
function addCostUnitMaterial($priceUnit, $unit) {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO CostUnitMaterial(costUnit, unit) VALUES(:costUnit, :unit)');

	try {
		$request->execute(array(
			'costUnit' => $priceUnit,
			'unit' => $unit
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $DB_DB->lastInsertId();
}

// Material in machine.

/**
 * Get the materials available for a machine.
 * @param $idMachine : ID of the machine to check.
 * @return int : list of materials or an error code if an error occurred.
 */
function getMaterialsMachine($idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Materials WHERE idMat IN (SELECT idMat FROM consume WHERE idMachine = :idMachine)");

	try {
		$request->execute(array(
			'idMachine' => $idMachine
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Assign one or multiple materials to a machine.
 * @param $idMachine : ID of the machine.
 * @param $idsMat : IDs of the materials.
 * @return int : an error code if an error occurred.
 */
function assignMaterialsToMachine($idMachine, $idsMat) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO consume (idMat, idMachine) VALUES (:idMat, :idMachine)");

	if(!is_array($idsMat))
		$idsMat = array($idsMat);

	foreach($idsMat as $idMat) {
		try {
			$request->execute(array(
				'idMat' => $idMat,
				'idMachine' => $idMachine
			));
		}
		catch(Exception $e) {
			return -2;
		}
	}

	return "";
}

/**
 * Unassign all materials for a machine.
 * @param $idMachine : ID of the machine.
 * @return int : an error code if an error occurred.
 */
function unassignMaterialsFromMachine($idMachine) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM consume WHERE idMachine = " . $idMachine);

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete all materials available for a machine and assign new ones.
 * @param $idMachine : ID of the machine.
 * @param $idsMat : ID of the materials.
 * @return int : an error code if an error occurred.
 */
function reassignMaterialsToMachine($idMachine, $idsMat) {
	$error_code = unassignMaterialsFromMachine($idMachine);
	if($error_code != "")
		return $error_code;

	$error_code = assignMaterialsToMachine($idMachine, $idsMat);
	if($error_code != "")
		return $error_code;

	return "";
}
