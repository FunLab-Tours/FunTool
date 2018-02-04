<?php

// TODO : check where to place function noLab().

/**
 * Check if there are labs in the database or not.
 * @return bool : true if there is no lab, false else, or an error code if an error occurred.
 */
function noLab() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(labName) as nb_entry FROM Lab");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	if($request->fetch()['nb_entry'] == 0)
		return true;
	return false;
}

include('include_static/header.php');
include('include_static/menu.php');

if(noLab()) {
	include('view/lab/index.php');
}
else if(isset($_COOKIE['id']) && sha1($_COOKIE['id'] . $privateKey) == $_COOKIE['token']) {
	if(isset($_GET['page']) && file_exists('view/' . $_GET['page'] . '/index.php')) {
		include('view/' . $_GET['page'] . '/index.php');
	}
	else {
		include('view/home/index.php');
	}
}
else {
	if(isset($_GET['page']) && file_exists('view/unconnected/' . $_GET['page'] . '.php')) {
		include('view/unconnected/' . $_GET['page'] . '.php');
	}
	else {
		include('view/unconnected/login.php');
	}
}

include('include_static/footer.php');
