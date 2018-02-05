<?php

/**
 * Add a new corporation.
 * @param $corporateName : name of the corporation.
 * @param $logo : link of the logo of the corporation.
 * @param $telephone : telephone number of the corporation.
 * @param $addressL1 : first address of the corporation.
 * @param $addressL2 : second address of the corporation (if needed).
 * @param $addressL3 : third address of the corporation (if needed).
 * @param $zipCode : zip code of the corporation.
 * @param $town : town of the corporation.
 * @param $country : country of the corporation.
 * @param $email : email of the corporation.
 * @return int : return an error code if an error occurred.
 */
function addCorporation($corporateName, $logo, $telephone, $addressL1, $addressL2, $addressL3, $zipCode, $town, $country, $email) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO Corporation( corporateName,
													  logo,
													  telephone,
													  addressL1,
													  addressL2,
													  addressL3,
													  zipCode,
													  town,
													  country,
													  email)
											  VALUES( :corporateName,
													  :logo,
			                                          :telephone,
													  :addressL1,
													  :addressL2,
													  :addressL3,
													  :zipCode,
													  :town,
													  :country,
													  :email)");

	try {
		$stmt->execute(array(
			'corporateName' => $corporateName,
			'logo' => $logo,
			'telephone' => $telephone,
			'addressL1' => $addressL1,
			'addressL2' => $addressL2,
			'addressL3' => $addressL3,
			'zipCode' => $zipCode,
			'town' => $town,
			'country' => $country,
			'email' => $email,
			'nbFunnies' => $DEFAULT_FUNNIES,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a corporation.
 * @param $idCorporation : ID of the corporation to delete.
 * @return int : return an error code if an error occurred.
 */
function deleteCorporation($idCorporation) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM Corporation WHERE idCorporation = :idCorporation");

	try {
		$request->execute(array(
			'idCorporation' => $idCorporation
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Update information about a corporation.
 * @param $idCorporation : ID of the corporation to update.
 * @param $corporateName : new name of the corporation.
 * @param $logo : new link of the logo of the corporation.
 * @param $telephone : new telephone number of the corporation.
 * @param $addressL1 : new first address of the corporation.
 * @param $addressL2 : new second address of the corporation (if needed).
 * @param $addressL3 : new third address of the corporation (if needed).
 * @param $zipCode : new zip code of the corporation.
 * @param $town : new town of the corporation.
 * @param $country : new country of the corporation.
 * @param $email : new email of the corporation.
 * @return int : return an error code if an error occurred.
 */
function updateCorporation($idCorporation, $corporateName, $logo, $telephone, $addressL1, $addressL2, $addressL3, $zipCode, $town, $country, $email) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE Corporation SET corporateName = :corporateName,
													logo = :logo,
													telephone = :telephone,
													addressL1 = :addressL1,
													addressL2 = :addressL2,
													addressL3 = :addressL3,
													zipCode = :zipCode,
													town = :town,
													country = :country,
													email = :email,
													nbFunnies = :nbFunnies
							 WHERE idCorporation = :idCorporation");

	try {
		$stmt->execute(array(
			'idCorporation' => $idCorporation,
			'corporateName' => $corporateName,
			'logo' => $logo,
			'telephone' => $telephone,
			'addressL1' => $addressL1,
			'addressL2' => $addressL2,
			'addressL3' => $addressL3,
			'zipCode' => $zipCode,
			'town' => $town,
			'country' => $country,
			'email' => $email,
			'nbFunnies' => $DEFAULT_FUNNIES
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * List all corporation.
 * @return mixed : list of all corporation or an error code if an error occurred.
 */
function listAllCorporation() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Corporation");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}
