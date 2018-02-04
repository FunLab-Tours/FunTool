<?php

/**
 * Add a new event.
 * @param $shortSumEvent : a short description about the event.
 * @param $longSumEvent : a complete description about the event.
 * @param $startDateEvent : the starting date of the event.
 * @param $endDateEvent : the ending date of the event.
 * @param $statusEvent : the current status of the event.
 * @param $nbPlaces : number of available places for the event.
 * @param $pricePlace : the price of a place for the event.
 * @return int : error code if an error occurred, else nothing.
 */
function addEvent($shortSumEvent, $longSumEvent, $startDateEvent, $endDateEvent, $statusEvent, $nbPlaces, $pricePlace) {
	global $DB_DB;
	$stmt = $DB_DB->prepare('INSERT INTO Events(shortSumEvent,
												longSumEvent,
												startDateEvent,
												endDatEvent, 
                                                statusEvent,
                                                nbPlaces,
                                                pricePlace) 
                                        VALUES( :shortSumEvent,
                                        		:longSumEvent,
                                        		:startDateEvent,
                                        		:endDateEvent,
                                        		:statusEvent,
                                                :nbPlaces,
                                                :pricePlace)');

	try {
		$stmt->execute(array(
			'shortSumEvent' => $shortSumEvent,
			'longSumEvent' => $longSumEvent,
			'startDateEvent' => $startDateEvent,
			'endDateEvent' => $endDateEvent,
			'statusEvent' => $statusEvent,
			'nbPlaces' => $nbPlaces,
			'pricePlace' => $pricePlace
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete an event.
 * @param $idEvent : ID of the event to delete.
 * @return int : error code if an error occurred, else nothing.
 */
function deleteEvent($idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM Events WHERE idEvent = :idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Edit an event.
 * @param $idEvent : ID of the event to edit.
 * @param $shortSumEvent : a short description about the event.
 * @param $longSumEvent : a complete description about the event.
 * @param $startDateEvent : the starting date of the event.
 * @param $endDateEvent : the ending date of the event.
 * @param $statusEvent : the current status of the event.
 * @param $nbPlaces : number of available places for the event.
 * @param $pricePlace : the price of a place for the event.
 * @return int : error code if an error occurred, else nothing.
 */
function updateEvent($idEvent, $shortSumEvent, $longSumEvent, $startDateEvent, $endDatEvent, $statusEvent, $nbPlaces, $pricePlace) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE Events SET shortSumEvent = :shortSumEvent, longSumEvent = :longSumEvent, startDateEvent = :startDateEvent, endDatEvent = :endDatEvent, statusEvent = :statusEvent, nbPlaces = :nbPlaces, pricePlace = :pricePlace WHERE idEvent = :idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent,
			'shortSumEvent' => $shortSumEvent,
			'longSumEvent' => $longSumEvent,
			'startDateEvent' => $startDateEvent,
			'endDatEvent' => $endDatEvent,
			'statusEvent' => $statusEvent,
			'nbPlaces' => $nbPlaces,
			'pricePlace' => $pricePlace

		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * List all event.
 * @return int : list of events, or an error code if an error occurred.
 */
function listAllEvent() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Events");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get a specific event.
 * @param $idEvent : ID of the event to get.
 * @return int : all attributes of the event, or an error code if an error occurred.
 */
function selectEvent($idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM Events WHERE idEvent=:idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetchAll();

	return $result;
}

// TODO : is that function really useful ?
/**
 * Select a label box.
 * @param $selected : name of the selected label box.
 * @return string : text associate with the label in the good language.
 */
function labelSelectBox($selected) {
	global $lang;

	switch($selected) {
		case 'ok':
			return $lang["statusOk"];
		case 'maybe':
			return $lang["statusMaybe"];
		case 'cancel':
			return $lang["statusCancel"];
		default:
			return '';
	}
}

/**
 * Edit the select box in function of the selected label.
 * @param $selected : selected label.
 * @return string : HTML code for the select box.
 */
function editLabelSelectBox($selected) { // TODO : correct the return ?
	global $lang;

	switch($selected) {

		case 'ok' :
			return "<option value=\"maybe\">" . $lang["statusMaybe"] . "</option><option value=\"cancel\">" . $lang["statusCancel"] . "</option>";
		case 'maybe':
			return "<option value=\"ok\">" . $lang["statusOk"] . "</option><option value=\"cancel\">" . $lang["statusCancel"] . "</option>";
		case 'cancel':
			return "<option value=\"ok\">" . $lang["statusOk"] . "</option><option value=\"maybe\">" . $lang["statusMaybe"] . "</option>";
		default:
			return '';
	}
}

/**
 * Return a text to know how many tickets are free on the total of tickets.
 * @param $allTickets : number total of tickets.
 * @param $idEvent : ID of the event to check.
 * @return int|mixed|string : string to say if the event is full or the number of tickets left. Or an error code if an error occurred.
 */
function ticketsLeft($allTickets, $idEvent) {
	global $DB_DB, $lang;
	$request = $DB_DB->prepare("SELECT COUNT(idUser) as ticketsSold FROM register WHERE idEvent = :idEvent");

	try {
		$request->execute(array(
			'idEvent' => $idEvent
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$ticketsSold = $request->fetch()['ticketsSold'];
	$ticketsLeft = $allTickets - $ticketsSold;

	if($ticketsLeft == 0)
		return $lang["full"];
	else
		return $ticketsLeft . "/" . $allTickets;
}

/**
 * Check if a user is registered on an event or not.
 * @param $idEvent : ID of the event to check.
 * @param $idUser : ID of the user to check.
 * @return bool|int : error code if an error occurred or a boolean to say if the user is registered or not.
 */
function alreadyRegistered($idEvent, $idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(idUser) as nb_entry FROM register WHERE idEvent = :idEvent AND idUser= :idUser");

	try {
		$request->execute(array(
			'idEvent' => $idEvent,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	if($request->fetch()['nb_entry'] == 0)
		return false;
	return true;
}

/**
 * Function to print the good registering button.
 * @param $ticketsLeft : number of tickets left for the event.
 * @param $idEvent : ID of the event to check.
 * @param $alreadyRegistered : boolean to say if the user is already registered or not.
 * @return string : HTML code for the button or a label if the event is full.
 */
function showRegisterButton($ticketsLeft, $idEvent, $alreadyRegistered) { // TODO : correct return ?
	global $lang;

	if($alreadyRegistered)
		return "<a href=\"index.php?page=event&idUnregister=$idEvent\" class=\"button\">" . $lang["unregister"] . "</a>";
	else if($ticketsLeft > 0)
		return "<a href=\"index.php?page=event&idRegister=$idEvent\" class=\"button\">" . $lang["register"] . "</a>";
	else
		return $lang["full"];
}

/**
 * Get the current number of funnies for a user.
 * @param $idUser : ID of the user.
 * @return int|mixed : error code if an error occurred or the number of funnies for the user.
 */
function currentUserFunnies($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT nbFunnies FROM User WHERE idUser =: idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result['nbFunnies'];
}

/**
 * Get the price of the ticket for an event.
 * @param $idEvent : ID of the event to check.
 * @return int|mixed : price of the ticket or error code if an error occurred.
 */
function ticketPrice($idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT pricePlace FROM Events WHERE idEvent = :idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result['pricePlace'];
}

/**
 * Register a user to an event.
 * @param $idUser : ID of the user to register.
 * @param $idEvent : ID of the event to register the user.
 * @return int : an error code if an error occurred.
 */
function userRegistrationToEvent($idUser, $idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO register(idUser, idEvent) VALUES(:idUser, :idEvent)");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
			'idEvent' => $idEvent
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$userFunniesLeft = currentUserFunnies($idUser) - ticketPrice($idEvent);
	updateUserFunnies($idUser, $userFunniesLeft);

	return "";
}

/**
 * Set a new number of funnies on the account of a user.
 * @param $idUser : ID of the user to update number of funnies.
 * @param $userFunniesLeft : new number of funnies for the user.
 * @return int : an error code if an error occurred, else nothing.
 */
function updateUserFunnies($idUser, $userFunniesLeft) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE User SET nbFunnies = :nbFunnies WHERE idUser = :idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
			'nbFunnies' => $userFunniesLeft
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Unregister a user from an event.
 * @param $idUser : ID of the user to unregister.
 * @param $idEvent : ID of the event.
 * @return int : an error code if an error occurred, else nothing.
 */
function userUnregistrationToEvent($idUser, $idEvent) { // TODO : rename.
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM register WHERE idUser = :idUser AND idEvent = :idEvent");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
			'idEvent' => $idEvent
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$userFunniesLeft = currentUserFunnies($idUser) + ticketPrice($idEvent);
	updateUserFunnies($idUser, $userFunniesLeft);

	return "";
}

/**
 * Select all user registered in an event.
 * @param $idEvent : ID of the event to check.
 * @return int|mixed : ID of all users in the event or error code if an error occurred.
 */
function selectAllUsersInEvent($idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT idUser FROM register WHERE idEvent =: idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetchAll();

	return $result;
}

/**
 * Select the name and the phone of all users registered to an event.
 * @param $idEvent : ID of the event to check.
 * @return int|mixed : first name and telephone number of all users registered to the event or an error code if an error occurred.
 */
function nameOfUsersInEvent($idEvent) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT firstName, telephone FROM User u INNER JOIN register r ON u.idUser = r.idUser WHERE idEvent =: idEvent");

	try {
		$stmt->execute(array(
			'idEvent' => $idEvent,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetchAll();

	return $result;
}
