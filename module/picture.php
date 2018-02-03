<?php

// TODO : use parameters.

/**
 * Check if the sent picture is valid or not.
 * @return bool : true if the picture is valid, false else.
 */
function isValidPicture() {
	$maxWidth = 60000;
	$maxHeight = 60000;

	if(!isset($_FILES['picture']))
		return false;

	if($_FILES['picture']['error'] > 0)
		return false;

	$image_sizes = getimagesize($_FILES['picture']['tmp_name']);
	if($image_sizes[0] > $maxWidth OR $image_sizes[1] > $maxHeight)
		return false;

	$extensions = array(
		'jpg',
		'jpeg',
		'gif',
		'png'
	);

	$ext_upload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));

	if(in_array($ext_upload, $extensions))
		return true;
}

/**
 * Add a picture to the database.
 * @return bool : false if an error occurred.
 */
function addPicture() {
	global $DB_DB;
	$request = $DB_DB->prepare('INSERT INTO Picture(picture) VALUES(:picture)');

	$name = md5(uniqid(rand(), true));
	$path = "uploaded/{$name}";
	$result = move_uploaded_file($_FILES['picture']['tmp_name'], $path);

	if(!$result)
		echo "Error.";

	try {
		$request->execute(array(
			'picture' => $name
		));
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Get the list of all pictures.
 * @return bool : list of pictures or false if an error occurred.
 */
function getPictureList() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT picture, pictureDescription FROM Picture");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetchAll();
}

/**
 * Delete the picture sent in POST.
 * @return bool : false if an error occurred.
 */
function deletePicture() {
	global $DB_DB;
	$request = $DB_DB->prepare('DELETE FROM Picture WHERE picture = :picture');

	try {
		$request->execute(array(
			'picture' => $_POST['picture']
		));

		unlink("uploaded/" . $_POST['picture']);
	}
	catch(Exception $e) {
		return false;
	}

	return true;
}

/**
 * Get information about a picture.
 * @param $idPicture : ID of the picture to check.
 * @return bool : false if an error occurred.
 */
function getPicture($idPicture) {
	global $DB_DB;
	$request = $DB_DB->prepare('SELECT picture, pictureDescription FROM Picture WHERE idPicture = :idPicture');

	try {
		$request->execute(array(
			'idPicture' => $idPicture
		));
	}
	catch(Exception $e) {
		return false;
	}

	return $request->fetch();
}
