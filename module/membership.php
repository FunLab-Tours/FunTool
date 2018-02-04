<?php

// TODO : correct membershiping.

/**
 * Add a membership settings.
 * @param $bonusMembership : funnies bonus when you become a member.
 * @param $entryDate : entry date of the setting.
 * @param $frameName : name of the setting.
 * @param $framePrice : price of the setting.
 * @param $frameComment : comment about the setting.
 * @return int : return an error code if an error occurred.
 */
function addMembershipFrame($bonusMembership, $entryDate, $frameName, $framePrice, $frameComment) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO 	MembershipFrame(bonusMembership, 
															entryDate,
															frameName,
															framePrice,
															frameComment)
											VALUES( :bonusMembership,
													:entryDate,
													:frameName,
													:framePrice,
													:frameComment)");

	try {
		$stmt->execute(array(
			'bonusMembership' => $bonusMembership,
			'entryDate' => $entryDate,
			'frameName' => $frameName,
			'framePrice' => $framePrice,
			'frameComment' => $frameComment
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * List all existing settings.
 * @return bool : all attributes of all settings or an error code if an error occurred.
 */
function listAllMembershipFrame() {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM MembershipFrame ORDER BY framePrice ASC");

	try {
		$request->execute();
	}
	catch(Exception $e) {
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Edit a membership setting.
 * @param $idMembershipFrame : ID of the setting to edit.
 * @param $bonusMembership : new funnies bonus when you become a member.
 * @param $entryDate : new entry date of the setting.
 * @param $frameName : new name of the setting.
 * @param $framePrice : new price of the setting.
 * @param $frameComment : new comment about the setting.
 * @return int : return an error code if an error occurred.
 */
function updateMembershipFrame($idMembershipFrame, $bonusMembership, $entryDate, $frameName, $framePrice, $frameComment) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE MembershipFrame SET bonusMembership = :bonusMembership,
														entryDate = :entryDate, 
                                                        frameName = :frameName,
                                                        framePrice = :framePrice,
                                                        frameComment = :frameComment
                                                  WHERE idMembershipFrame = :idMembershipFrame");

	try {
		$stmt->execute(array(
			'bonusMembership' => $bonusMembership,
			'entryDate' => $entryDate,
			'frameName' => $frameName,
			'framePrice' => $framePrice,
			'frameComment' => $frameComment,
			'idMembershipFrame' => $idMembershipFrame
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Delete a membership setting.
 * @param $idMembershipFrame : ID of the setting to delete.
 * @return int : return an error code if an error occurred.
 */
function deleteMembershipFrame($idMembershipFrame) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM MembershipFrame WHERE idMembershipFrame = :idMembershipFrame");

	try {
		$stmt->execute(array(
			'idMembershipFrame' => $idMembershipFrame
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get information about a membership setting.
 * @param $idMembershipFrame : ID of the membership.
 * @return bool : all attributes about the membership or an error code if an error occurred.
 */
function selectMembershipFrame($idMembershipFrame) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM MembershipFrame WHERE idMembershipFrame =: idMembershipFrame");

	try {
		$stmt->execute(array(
			'idMembershipFrame' => $idMembershipFrame,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Add a membership.
 * @param $membershipingDate : date of the membership.
 * @param $endMembershipDate : ending date for the user to be a member.
 * @param $paymentMethod : how the user will pay his membership.
 * @param $adminCommentary : comment about the membership.
 * @param $idMembershipFrame : ID of the used setting.
 * @param $idUser : ID of the user to add as a member.
 * @return int : return an error code if an error occurred.
 */
function addMembership($membershipingDate, $endMembershipDate, $paymentMethod, $adminCommentary, $idMembershipFrame, $idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("INSERT INTO membershipTransaction(	membershipingDate,
																endMembershipDate,
																paymentMethod,
				 	                                            adminCommentary,
				 	                                            idMembershipFrame,
				 	                                            idUser)                                                 
														VALUES(	:membershipingDate,
																:endMembershipDate,
																:paymentMethod, 
                                        						:adminCommentary,
                                        						:idMembershipFrame,
                                        						:idUser)");

	try {
		$stmt->execute(array(
			'membershipingDate' => $membershipingDate,
			'endMembershipDate' => $endMembershipDate,
			'paymentMethod' => $paymentMethod,
			'adminCommentary' => $adminCommentary,
			'idMembershipFrame' => $idMembershipFrame,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get the ending date for the membership of a user.
 * @param $idUser : ID of the user.
 * @return bool : ending date or an error code if an error occurred.
 */
function returnValidDateForMembership($idUser) {
	if(isset(selectMembership($idUser)['endMembershipDate']))
		return selectMembership($idUser)['endMembershipDate'];
	else
		return -3;
}

/**
 * Compare two dates.
 * @param $date1 : first date.
 * @param $date2 : second date.
 * @return int|string : difference between date. Negative if first date is after the second date.
 */
function compareTwoDates($date1, $date2) {
	if($date2) {
		$date1ToCompare = date_create($date1);
		$date2ToCompare = date_create($date2);
		$diffDate = date_diff($date1ToCompare, $date2ToCompare);
		$valueDiffDate = $diffDate->format("%R%a");

		return $valueDiffDate;
	}
	else
		return -3;
}

/**
 * Update a membership.
 * @param $membershipingDate : new date of the membership.
 * @param $endMembershipDate : new ending date for the user to be a member.
 * @param $paymentMethod : new method used to pay the membership.
 * @param $adminCommentary : new comment about the membership.
 * @param $idMembershipFrame : new ID of the used setting.
 * @param $idUser : ID of the user to edit the membership.
 * @return int : return an error code if an error occurred.
 */
function updateMembership($membershipingDate, $endMembershipDate, $paymentMethod, $adminCommentary, $idMembershipFrame, $idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE membershipTransaction SET 	membershipingDate = :membershipingDate, 
																endMembershipDate = :endMembershipDate,
																paymentMethod = :paymentMethod,
                                 								adminCommentary = :adminCommentary,
                                 								idMembershipFrame = :idMembershipFrame
														 WHERE 	idUser = :idUser");

	try {
		$stmt->execute(array(
			'membershipingDate' => $membershipingDate,
			'endMembershipDate' => $endMembershipDate,
			'paymentMethod' => $paymentMethod,
			'adminCommentary' => $adminCommentary,
			'idMembershipFrame' => $idMembershipFrame,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Get how a user payed to become a member.
 * @param $idUser : ID of the user.
 * @return bool : method used or an error code if an error occurred.
 */
function selectPaymentMethodInMembership($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT paymentMethod FROM membershipTransaction WHERE idUser=:idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch()[0];

	return $result;
}

/**
 * List all membership.
 * @return mixed : all attributes from all memberships.
 */
function listAllMembership() {
	global $DB_DB;
	$result = $DB_DB->query("SELECT * FROM membershipTransaction");

	return $result;
}

/**
 * Get all attributes of the membership of a user.
 * @param $idUser : ID of the user.
 * @return bool : all attributes of the membership of a user or an error code if an error occurred.
 */
function selectMembership($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM membershipTransaction WHERE idUser =: idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}

/**
 * Delete a membership.
 * @param $idUser : ID of the user.
 * @return int : return an error code if an error occurred.
 */
function deleteMembership($idUser) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("DELETE FROM membershipTransaction WHERE idUser = :idUser");

	try {
		$stmt->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Add funnies when a user become a member.
 * @param $idUser : ID of the user.
 * @param $bonusMembership : bonus to add.
 * @return int : return an error code if an error occurred.
 */
function addFunnies($idUser, $bonusMembership) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("UPDATE User SET nbFunnies = nbFunnies + :bonusMembership WHERE idUser = :idUser");

	try {
		$stmt->execute(array(
			'bonusMembership' => $bonusMembership,
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		return -2;
	}

	return "";
}

/**
 * Find users who their name or login contain the given argument.
 * @param $login : name to search.
 * @return bool : list of all users found or an error code if an error occurred.
 */
function searchUser($login) {
	global $DB_DB;
	$stmt = $DB_DB->prepare("SELECT * FROM User WHERE login=:login LIKE '%" . $login . "%'");

	try {
		$stmt->execute(array(
			'login' => $login,
		));
	}
	catch(Exception $e) {
		return -2;
	}

	$result = $stmt->fetch();

	return $result;
}
