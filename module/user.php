<?php

include('include/config.php');

/**
 * Check if the couple of login and password is valid or not.
 * @param $login : login.
 * @param $password : password.
 * @return bool : true if the couple is valid, false else. Can throw an error code.
 */
function isValidUser($login, $password) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT COUNT(login) as nb_entry, password FROM User WHERE login = :login');

	try {
		$request->execute(array(
			'login' => $login
		));
	}
	catch(Exception $e) {
		return false; // TODO : error code.
	}

	$result = $request->fetch();

	if(password_verify($password, $result['password']) && $result['nb_entry'] == 1)
		return true;
	return false;
}

/**
 * Connect a user and set a cookie on his computer.
 * @param $login : login of the user.
 * @return bool : false if an error occurred.
 */
function connectUser($login) {
	global $DB_DB, $privateKey;
	$request = $DB_DB->prepare('SELECT idUser FROM User WHERE login = :login');

	try {
		$request->execute(array(
			'login' => $login,
		));
	}
	catch(Exception $e) {
		return false;
	}

	$result = $request->fetch();

	setcookie("id", $result['idUser'], time() + 300000, "/");
	setcookie("token", sha1($result['idUser'] . $privateKey), time() + 30000, "/");
}

/**
 * Check if the POST variables are valid to add a user or not.
 * @return bool : true if the form is valid or an error text if not.
 */
function isValidSignOn() {
	if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['passwordChecker']) && isset($_POST['firstName']) && isset($_POST['name']) && isset($_POST['telephone']) && isset($_POST['addressL1']) && isset($_POST['zipCode']) && isset($_POST['town']) && isset($_POST['country']) && isset($_POST['email']) && isset($_POST['birthDate'])) {
		// TODO : extract echo.
		if(!isValidNewLogin($_POST['login'])) {
			echo "Error on login.";
			return false;
		}

		if(!isValidPassword($_POST['password'], $_POST['passwordChecker'])) {
			echo "Error on password.";
			return false;
		}

		if(!isValidFirstName($_POST['firstName'])) {
			echo "Error on first name.";
			return false;
		}

		if(!isValidName($_POST['name'])) {
			echo "Error on name.";
			return false;
		}

		if(!isValidTelephone($_POST['telephone'])) {
			echo "Error on phone number.";
			return false;
		}

		if(!isValidAddressL1($_POST['addressL1'])) {
			echo "Error on first address.";
			return false;
		}

		if(!isValidZipCode($_POST['zipCode'])) {
			echo "Error on zip code.";
			return false;
		}

		if(!isValidTown($_POST['town'])) {
			echo "Error on town.";
			return false;
		}

		if(!isValidCountry($_POST['country'])) {
			echo "Error on country.";
			return false;
		}

		if(!isValidEmail($_POST['email'])) {
			echo "Error on email.";
			return false;
		}

		if(!isValidBirthDate($_POST['birthDate'])) {
			echo "Error on birth date.";
			return false;
		}

		return true;
	}

	return false;
}

/**
 * Check if the login is available or not.
 * @param $login : login.
 * @return bool : true if the login is available, false else. Can throw an error code.
 */
function isValidNewLogin($login) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT COUNT(login) as nb_entry FROM User WHERE login = :login');

	if($login == "")
		return false;

	if(!preg_match("#^[a-zA-Z0-9]{3,}$#", $login))
		return false;

	try {
		$request->execute(array(
			'login' => $login
		));
	}
	catch(Exception $e) {
		return false; // TODO : error code.
	}

	$result = $request->fetch();

	if($result['nb_entry'] == 1)
		return false;
	return true;
}

/**
 * Check if a password is valid.
 * @param $password : password.
 * @param $passwordConfirmation : second form to confirm the password.
 * @return bool : true if the password is valid, false else.
 */
function isValidPassword($password, $passwordConfirmation) {
	if($password == "")
		return false;

	if(strlen($password) < 8 || strcmp($password, $passwordConfirmation) != 0)
		return false;

	return true;
}

/**
 * Check if the first name of the user is valid or not.
 * @param $firstName : first name of the user.
 * @return bool : true if the first name is valid, false else.
 */
function isValidFirstName($firstName) {
	if($firstName == "")
		return false;

	if(!preg_match("#^([a-zA-Z]|[- ]){3,}$#", $firstName))
		return false;

	return true;
}

/**
 * Check if the name of the user is valid or not.
 * @param $name : name of the user.
 * @return bool : true if the name is valid, false else.
 */
function isValidName($name) {
	if($name == "")
		return false;

	if(!preg_match("#^([a-zA-Z]|[- ]){3,}$#", $name))
		return false;

	return true;
}

/**
 * Check if a phone number is valid or not.
 * @param $telephone : phone number.
 * @return bool : true if the phone number is valid, false else.
 */
function isValidTelephone($telephone) {
	if($telephone == "")
		return false;

	if(!preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $telephone))
		return false;

	return true;
}

/**
 * Check if the address if valid or not.
 * @param $addressL1 : address to check.
 * @return bool : true if the address is valid, false else.
 */
function isValidAddressL1($addressL1) {
	if($addressL1 == "")
		return false;
	return true;
}

/**
 * Check if a zip code is valid or not.
 * @param $zipCode : zip code to check.
 * @return bool : true if the zip code is valid, false else.
 */
function isValidZipCode($zipCode) {
	if($zipCode == "")
		return false;

	if(!preg_match("#^[0-9]{5}$#", $zipCode))
		return false;

	return true;
}

/**
 * Check if a town is valid or not.
 * @param $town : town to check.
 * @return bool : true if the town is valid, false else.
 */
function isValidTown($town) {
	if($town == "")
		return false;

	if(!preg_match("#^[a-zA-Z]{3,}$#", $town))
		return false;

	return true;
}

/**
 * Check if a country is valid or not.
 * @param $country : country to check.
 * @return bool : true if the country is valid, false else.
 */
function isValidCountry($country) {
	if($country == "")
		return false;

	if(!preg_match("#^[a-zA-Z]{3,}$#", $country))
		return false;

	return true;
}

/**
 * Check if an email is valid or not.
 * @param $email : email to check.
 * @return bool : true if the email is valid, false else.
 */
function isValidEmail($email) {
	if($email == "")
		return false;

	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		return false;

	return true;
}

/**
 * Check if a birth date is valid or not.
 * @param $birthDate : birth date to check.
 * @return bool : true if the birth date is valid, false else.
 */
function isValidBirthDate($birthDate) {
	if($birthDate == "")
		return false;
	return true;
}

/**
 * Add a user.
 * @param $login : login of the user.
 * @param $password : password of the user.
 * @param $firstName : first name of the user.
 * @param $name : name of the user.
 * @param $telephone : phone number of the user.
 * @param $addressL1 : first address of the user.
 * @param $addressL2 : second address of the user (if needed).
 * @param $addressL3 : third address of the user (if needed).
 * @param $zipCode : zip code of the user.
 * @param $town : town of the user.
 * @param $country : country of the user.
 * @param $email : email of the user.
 * @param $emailBis : second email of the user (if needed).
 * @param $birthDate : birth date of the user.
 * @param $inscriptionActiveList : true if the user subscribe to the active list, false else.
 * @param $inscriptionNews : true if the user subscribe to the newsletter, false else.
 * @param $picture : link to the profile picture of the user.
 * @return bool|void : false or error text if an error occurred.
 */
function addUser($login, $password, $firstName, $name, $telephone, $addressL1, $addressL2, $addressL3, $zipCode, $town, $country, $email, $emailBis, $birthDate, $inscriptionActiveList, $inscriptionNews, $picture) {
	global $DB_DB, $privateKey, $DEFAULT_FUNNIES, $max_upload_size, $base_url;

	$inscriptionActiveListBoolean = ($inscriptionActiveList == "true") ? 1 : 0;
	$inscriptionNewsBoolean = ($inscriptionNews == "true") ? 1 : 0;

	// First of all, we add the profile picture.
	$request = $DB_DB->prepare('INSERT INTO Picture (picture, pictureDescription, categoryPicture) VALUE (:picture, :pictureDescription, :categoryPicture)');

	try {
		$folder = 'assets/user_images/';
		$size = filesize($_FILES['idPicture']['tmp_name']);

		// if(!getimagesize($_FILES['idPicture']['tmp_name'])) {
		//     echo 'Ce fichier n\'est pas une image!';
		//     return ;
		// }
		if($size > $max_upload_size) {
			echo 'Taille maximale dépassée!';
			return;
		}

		$image_link = $folder . sha1($login . $privateKey) . '.' . pathinfo($_FILES['idPicture']['name'], PATHINFO_EXTENSION);

		// if(!move_uploaded_file($_FILES['idPicture']['tmp_name'], $image_link)){
		//     echo 'Echec de l\'upload !';
		//     return ;
		// }

		$request->execute(array(
			'picture' => $base_url . $image_link,
			'pictureDescription' => $login,
			'categoryPicture' => "ProfilUser"
		));

		$idPicture = $DB_DB->lastInsertId();
	}
	catch(Exception $e) {
		$idPicture = NULL;
	}

	// Then, we add the user.
	$request = $DB_DB->prepare('INSERT INTO User( login,
                                                      password,
                                                      firstName,
                                                      name,
                                                      telephone,
                                                      addressL1,
                                                      addressL2,
                                                      addressL3,
                                                      zipCode,
                                                      town,
                                                      country,
                                                      email,
                                                      emailBis,
                                                      birthDate,
                                                      nbFunnies,
                                                      inscriptionActiveList,
                                                      inscriptionNews,
                                                      idPicture)
                                    VALUES( :login,
                                            :password,
                                            :firstName,
                                            :name,
                                            :telephone,
                                            :addressL1,
                                            :addressL2,
                                            :addressL3,
                                            :zipCode,
                                            :town,
                                            :country,
                                            :email,
                                            :emailBis,
                                            :birthDate,
                                            :nbFunnies,
                                            :inscriptionActiveList,
                                            :inscriptionNews,
                                            :idPicture)');

	try {
		$request->execute(array(
			'login' => $login,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'firstName' => $firstName,
			'name' => $name,
			'telephone' => $telephone,
			'addressL1' => $addressL1,
			'addressL2' => $addressL2,
			'addressL3' => $addressL3,
			'zipCode' => $zipCode,
			'town' => $town,
			'country' => $country,
			'email' => $email,
			'emailBis' => $emailBis,
			'birthDate' => $birthDate,
			'nbFunnies' => $DEFAULT_FUNNIES,
			'inscriptionActiveList' => $inscriptionActiveListBoolean,
			'inscriptionNews' => $inscriptionNewsBoolean,
			'idPicture' => $idPicture
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Disconnect the connected user (delete his cookies).
 */
function disconnectUser() {
	unset($_COOKIE["id"]);
	unset($_COOKIE["token"]);

	setcookie("id", null, -1, '/');
	setcookie("token", null, -1, '/');
}

/**
 * Get information about a user.
 * @param $idUser : ID of the user.
 * @return bool : all attributes about the user or false if an error occurred.
 */
function getUser($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetch();
}

/**
 * Get the list of users.
 * @return bool : all attributes of all users or false if an error occurred.
 */
function getUserList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Edit the connected user.
 * @param $login : login of the user.
 * @param $password : password of the user.
 * @param $firstName : first name of the user.
 * @param $name : name of the user.
 * @param $telephone : phone number of the user.
 * @param $addressL1 : first address of the user.
 * @param $addressL2 : second address of the user (if needed).
 * @param $addressL3 : third address of the user (if needed).
 * @param $zipCode : zip code of the user.
 * @param $town : town of the user.
 * @param $country : country of the user.
 * @param $email : email of the user.
 * @param $emailBis : second email of the user (if needed).
 * @param $birthDate : birth date of the user.
 * @param $inscriptionActiveList : true if the user subscribe to the active list, false else.
 * @param $inscriptionNews : true if the user subscribe to the newsletter, false else.
 * @param $picture : link to the profile picture of the user.
 * @return bool : false if an error occurred.
 */
function editUser($firstName, $name, $telephone, $addressL1, $addressL2, $addressL3, $zipCode, $town, $country, $email, $emailBis, $birthDate, $inscriptionActiveList, $inscriptionNews, $picture) {
	global $DB_DB;

	$inscriptionActiveListBoolean = ($inscriptionActiveList == "true") ? 1 : 0;
	$inscriptionNewsBoolean = ($inscriptionNews == "true") ? 1 : 0;

	$request = $DB_DB->prepare("SELECT login FROM User WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $_COOKIE['id']
		));
	}
	catch(Exception $e) {
		return false;
	}

	$login = $request->fetch()[0];

	// First, we modify the profile picture if needed.
	$request = $DB_DB->prepare("SELECT idPicture
								FROM Picture
								WHERE picture
								LIKE :picture AND INSTR(pictureDescription, :login) <> 0");

	try {
		$request->execute(array(
			'picture' => $picture,
			'login' => $login
		));
	}
	catch(Exception $e) {
		return false;
	}

	$idPicture = $request->fetch()[0];

	if($idPicture == null) {
		$request = $DB_DB->prepare('INSERT INTO Picture (picture, pictureDescription, categoryPicture) VALUE (:picture, :pictureDescription, :categoryPicture)');
		try {
			$request->execute(array(
				'picture' => $picture,
				'pictureDescription' => "Avatar for user " . $login,
				'categoryPicture' => "ProfilUser"
			));

			$idPicture = $DB_DB->lastInsertId();
		}
		catch(Exception $e) {
			$idPicture = NULL;
		}
	}

	// Then we add the user.
	$request = $DB_DB->prepare('UPDATE User SET firstName = :firstName,
                                                    name = :name,
                                                    telephone = :telephone,
                                                    addressL1 = :addressL1,
                                                    addressL2 = :addressL2,
                                                    addressL3 = :addressL3,
                                                    zipCode = :zipCode,
                                                    town = :town,
                                                    country = :country,
                                                    email = :email,
                                                    emailBis = :emailBis,
                                                    birthDate = :birthDate,
                                                    inscriptionActiveList = :inscriptionActiveList,
                                                    inscriptionNews = :inscriptionNews,
                                                    idPicture = :idPicture
                                     WHERE idUser = ' . $_COOKIE['id']);

	try {
		$request->execute(array(
			'firstName' => $firstName,
			'name' => $name,
			'telephone' => $telephone,
			'addressL1' => $addressL1,
			'addressL2' => $addressL2,
			'addressL3' => $addressL3,
			'zipCode' => $zipCode,
			'town' => $town,
			'country' => $country,
			'email' => $email,
			'emailBis' => $emailBis,
			'birthDate' => $birthDate,
			'inscriptionActiveList' => $inscriptionActiveListBoolean,
			'inscriptionNews' => $inscriptionNewsBoolean,
			'idPicture' => $idPicture
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Edit the password of the connected user.
 * @param $old : old password.
 * @param $new : new password.
 * @return bool : false if an error occurred.
 */
function editPassword($old, $new) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT password FROM User WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $_COOKIE['id']
		));
	}
	catch(Exception $e) {
		return false;
	}

	$password = $request->fetch()[0];

	if(password_verify($old, $password)) {
		$request = $DB_DB->prepare('UPDATE User SET User.password = :new WHERE idUser = :id');

		$request->execute(array(
			'new' => password_hash($new, PASSWORD_DEFAULT),
			'id' => $_COOKIE['id']
		));

		return true;
	}

	return false;
}

/**
 * Select all information about all users.
 * @return bool : all attributes about all users or false if an error occurred.
 */
function allUser() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Check if a user is a member of the lab or not.
 * @param $idUser : ID of the user.
 * @return bool : true if the user is a member, false else. Can throw an error code.
 */
function isMember($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT COUNT(idUser) as isMember FROM membershipTransaction WHERE idUser = :idUser');

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return false; // TODO : error code.
	}

	if($request->fetch()['isMember'] == 1)
		return true;
	return false;
}

/**
 * Create a random password.
 * @param int $length : length of the password.
 * @return bool|string : password generated.
 */
function random_password($length = 8) {
	$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	$password = substr(str_shuffle($charset), 0, $length);
	return $password;
}
