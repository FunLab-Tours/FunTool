<?php

/**
 * Get the stock of a material.
 * @param $idMaterial : ID of the material.
 * @return array|bool : quantity of material or an error code if an error occurred.
 */
function getMaterialStock($idMaterial) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Materials WHERE idMat = :idMat");

	try {
		$request->execute(array(
			'idMat' => $idMaterial
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$result = $request->fetch();

	return $result;
}

/**
 * Update the quantity of materials.
 * @param $idMaterial : ID of the material.
 * @param $suppliesToAdd : quantity of materials.
 * @return int : return an error code if an error occurred.
 */
function setMaterialsQuantity($idMaterial, $suppliesToAdd) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Materials SET supplies = :supplies, dateUpdate = :dateUpdate WHERE idMat = :idMat");

	try {
		$request->execute(array(
			'idMat' => $idMaterial,
			'supplies' => $suppliesToAdd,
			'dateUpdate' => date_create("now")->format("Y-m-d H:i:s")
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}
