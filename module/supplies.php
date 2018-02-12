<?php

/**
 * Get the stock of a material.
 * @param $idLab : ID of the lab who got the material.
 * @param $idMaterial : ID of the material.
 * @return array|bool : quantity of material or an error code if an error occurred.
 */
function getMaterialStock($idLab, $idMaterial) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM labSupplies WHERE idLab = :idLab AND idMat = :idMat");

	try {
		$request->execute(array(
			'idLab' => $idLab,
			'idMat' => $idMaterial
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$result = $request->fetchAll();

	if(empty($result))
		return array(
			'idLab' => $idLab,
			'idMat' => $idMaterial,
			'quantityInStock' => 0,
			'lastRestock' => null
		);

	return $result[0];
}

/**
 * Update the quantity of materials.
 * @param $idLab : ID of the lab which contain the material.
 * @param $idMaterial : ID of the material.
 * @param $nbr : quantity of materials.
 * @return int : return an error code if an error occurred.
 */
function addMaterialsQuantity($idLab, $idMaterial, $nbr) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(*) FROM labSupplies WHERE idLab = :idLab AND idMat = :idMat");

	try {
		$request->execute(array(
			'idLab' => $idLab,
			'idMat' => $idMaterial
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$count = $request->fetch()[0];

	if($count == 0) {
		$request = $DB_DB->prepare("INSERT INTO labSupplies(idLab, idMat, quantityInStock, lastRestock) VALUES(:idLab, :idMat, :nbr, :date)");

		if($nbr < 0)
			$nbr = 0;
		if($nbr > 0)
			$date = date_create("now")->format("Y-m-d H:i:s");
		else
			$date = null;

		try {
			$request->execute(array(
				'idLab' => $idLab,
				'idMat' => $idMaterial,
				'nbr' => $nbr,
				'date' => $date
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}
	else {
		if($nbr > 0) {
			$request = $DB_DB->prepare("UPDATE labSupplies SET quantityInStock = quantityInStock + :nbr, lastRestock = :date WHERE idLab = :idLab AND idMat = :idMat");

			try {
				$request->execute(array(
					'idLab' => $idLab,
					'idMat' => $idMaterial,
					'nbr' => $nbr,
					'date' => date_create("now")->format("Y-m-d H:i:s")
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}
		}
		else {
			$request = $DB_DB->prepare("UPDATE labSupplies SET quantityInStock = quantityInStock + :nbr WHERE idLab = :idLab AND idMat = :idMat");

			try {
				$request->execute(array(
					'idLab' => $idLab,
					'idMat' => $idMaterial,
					'nbr' => $nbr,
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}
		}
	}

	return "";
}
