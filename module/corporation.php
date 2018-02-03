<?php

// TODO : change adress to address..
// TODO : correct POST.

/**
 * Add a new corporation.
 * @param $corporateName : name of the corporation.
 * @param $logo : link of the logo of the corporation.
 * @param $telephone : telephone number of the corporation.
 * @param $adressL1 : first address of the corporation.
 * @param $adressL2 : second address of the corporation (if needed).
 * @param $adressL3 : third address of the corporation (if needed).
 * @param $zipCode : zip code of the corporation.
 * @param $town : town of the corporation.
 * @param $country : country of the corporation.
 * @param $email : email of the corporation.
 * @param $nbFunnies : number of funnies of the corporation. // TODO : delete that parameter to pass by a default value.
 */
function addCorporation($corporateName, $logo, $telephone, $adressL1, $adressL2, $adressL3, $zipCode, $town, $country, $email, $nbFunnies) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO Corporation( corporateName,
													  logo,
													  telephone,
													  adressL1,
													  adressL2,
													  adressL3,
													  zipCode,
													  town,
													  country,
													  email,
													  nbFunnies)
											  VALUES( :corporateName,
													  :logo,
			                                          :telephone,
													  :adressL1,
													  :adressL2,
													  :adressL3,
													  :zipCode,
													  :town,
													  :country,
													  :email,
											 		  :nbFunnies)");

	try {
		$stmt->execute(array(
			'corporateName' => $_POST['corporateName'],
			'logo' => $_POST['logo'],
			'telephone' => $_POST['telephone'],
			'adressL1' => $_POST['adressL1'],
			'adressL2' => $_POST['adressL2'],
			'adressL3' => $_POST['adressL3'],
			'zipCode' => $_POST['zipCode'],
			'town' => $_POST['town'],
			'country' => $_POST['country'],
			'email' => $_POST['email'],
			'nbFunnies' => $_POST['nbFunnies'],
		));
	}
	catch(Exception $e) {
		echo $e;
	}
}

/**
 * Delete a corporation.
 * @param $idCorporation : ID of the corporation to delete.
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
		echo $e;
	}
}

/**
 * Update information about a corporation.
 * @param $idCorporation : ID of the corporation to update.
 * @param $corporateName : new name of the corporation.
 * @param $logo : new link of the logo of the corporation.
 * @param $telephone : new telephone number of the corporation.
 * @param $adressL1 : new first address of the corporation.
 * @param $adressL2 : new second address of the corporation (if needed).
 * @param $adressL3 : new third address of the corporation (if needed).
 * @param $zipCode : new zip code of the corporation.
 * @param $town : new town of the corporation.
 * @param $country : new country of the corporation.
 * @param $email : new email of the corporation.
 * @param $nbFunnies : new number of funnies of the corporation. // TODO : delete that parameter to pass by a default value.
 */
function updateCorporation($idCorporation, $corporateName, $logo, $telephone, $adressL1, $adressL2, $adressL3, $zipCode, $town, $country, $email, $nbFunnies) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE Corporation SET corporateName = :corporateName,
													logo = :logo,
													telephone = :telephone,
													adressL1 = :adressL1,
													adressL2 = :adressL2,
													adressL3 = :adressL3,
													zipCode = :zipCode,
													town = :town,
													country = :country,
													email = :email,
													nbFunnies = :nbFunnies
							 WHERE idCorporation = :idCorporation");

	try {
		$stmt->execute(array(
			'corporateName' => $_POST['corporateName'],
			'logo' => $_POST['logo'],
			'telephone' => $_POST['telephone'],
			'adressL1' => $_POST['adressL1'],
			'adressL2' => $_POST['adressL2'],
			'adressL3' => $_POST['adressL3'],
			'zipCode' => $_POST['zipCode'],
			'town' => $_POST['town'],
			'country' => $_POST['country'],
			'email' => $_POST['email'],
			'nbFunnies' => $_POST['nbFunnies'],
		));
	}
	catch(Exception $e) {
		echo $e;
	}
}

/**
 * List all corporation.
 * @return mixed : list of all corporation or error code if an error occurred.
 */
function listAllCorporation() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Corporation");

	try {
		$request->execute();
	}
	catch(Exception $e) {
	}

	return $request->fetchAll();
}
