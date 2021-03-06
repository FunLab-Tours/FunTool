<?php

/**
 * Create a new conversation between multiple users.
 * @param $idUsers : ID of the users in the conversation.
 * @param $name : name of the conversation.
 * @return bool : the ID of the conversation if it has been added, or an error code if an error occurred.
 */
function createConversation($idUsers, $name) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Conversation (name, startDateTime) VALUES (:name, :startDateTime)");

	if(sizeof($idUsers) == 1)
		$name = null;

	try {
		$request->execute(array(
			'name' => $name,
			'startDateTime' => date_create("now")->format("Y-m-d H:i:s")
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$idConversation = $DB_DB->lastInsertId();

	array_push($idUsers, $_COOKIE['id']);
	addUsersToConversation($idConversation, $idUsers);

	return $idConversation;
}

/**
 * List all conversation of a specific user.
 * @param $idUser : ID of the user to check.
 * @return mixed : all attributes of all conversations of the user, or an error code if an error occurred.
 */
function listConversations($idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Conversation WHERE idConversation IN (SELECT idConversation FROM userInConversation WHERE idUser = :idUser)");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get a conversation.
 * @param $idConversation : ID of the conversation to get.
 * @return mixed : all attributes of the conversation, or an error code if an error occurred.
 */
function getConversation($idConversation) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Conversation WHERE idConversation = :idConversation");

	try {
		$request->execute(array(
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll()[0];
}

/**
 * Get all messages in a conversation.
 * @param $idConversation : ID of the conversation to get.
 * @return mixed : all attributes of all messages in the conversation, or an error code if an error occurred.
 */
function getMessages($idConversation) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Message WHERE idConversation = :idConversation ORDER BY sentDateTime");

	try {
		$request->execute(array(
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Get the list of users in a conversation.
 * @param $idConversation : ID of the conversation to get.
 * @return mixed : all attributes of all the users in the conversation, or an error code if an error occurred.
 */
function getUsersInConversation($idConversation) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (SELECT idUser FROM userInConversation WHERE idConversation = :idConversation)");

	try {
		$request->execute(array(
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll();
}

/**
 * Search a conversation and create a new one if the conversation doesn't exist.
 * @param $idUser : ID of the user in the conversation.
 * @param $idRecipient : ID of the recipient.
 * @return int : return the ID of the conversation if it has been added or an error code if an error occurred.
 */
function searchForConversation($idUser, $idRecipient) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT idConversation FROM userInConversation WHERE idUser = :idUser");

	try {
		$request->execute(array(
			'idUser' => $idUser
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$idConversations = $request->fetchAll();

	foreach($idConversations as $idConversation) {
		if(countUserInConversation($idConversation['idConversation']) == 2) {
			$request = $DB_DB->prepare("SELECT * FROM userInConversation WHERE idUser = :idRecipient AND idConversation = :idConversation");

			try {
				$request->execute(array(
					'idConversation' => $idConversation['idConversation'],
					'idRecipient' => $idRecipient
				));
			}
			catch(Exception $e) {
				if($DEBUG_MODE)
					echo $e;
				return -2;
			}

			$conversation = $request->fetchAll();

			if(!empty($conversation))
				return $idConversation['idConversation'];
		}
	}

	return createConversation(array($idRecipient), null);
}

/**
 * Count the number of users in a conversation.
 * @param $idConversation : ID of the conversation to count.
 * @return mixed : number of users in the conversation, or an error code if an error occurred.
 */
function countUserInConversation($idConversation) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(idUser) FROM userInConversation WHERE idConversation = :idConversation");

	try {
		$request->execute(array(
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetch()['COUNT(idUser)'];
}

/**
 * Change the name of a conversation.
 * @param $idConversation : ID of the conversation to edit.
 * @param $name : new name of the conversation, or an error code if an error occurred.
 */
function changeConversationName($idConversation, $name) {
	global $DB_DB;
	$request = $DB_DB->prepare("UPDATE Conversation SET name = :name WHERE idConversation = :idConversation");

	try {
		$request->execute(array(
			'idConversation' => $idConversation,
			'name' => $name
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

/**
 * Add users in a conversation.
 * @param $idConversation : ID of the conversation to add users.
 * @param $idUsers : list of users to add.
 * @return int : return an error code if an error occurred.
 */
function addUsersToConversation($idConversation, $idUsers) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO userInConversation (idUser, idConversation) VALUES (:idUser, :idConversation)");

	foreach($idUsers as $idUser) {
		try {
			$request->execute(array(
				'idUser' => $idUser,
				'idConversation' => $idConversation
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}

	return "";
}

/**
 * Remove many users in a conversation.
 * @param $idConversation : ID of the conversation.
 * @param $idUsers : list of users to remove.
 * @return int : return an error code if an error occurred.
 */
function removeUsersFromConversation($idConversation, $idUsers) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM userInConversation WHERE idUser = :idUser AND idConversation = :idConversation");

	foreach($idUsers as $idUser) {
		try {
			$request->execute(array(
				'idUser' => $idUser,
				'idConversation' => $idConversation
			));
		}
		catch(Exception $e) {
			if($DEBUG_MODE)
				echo $e;
			return -2;
		}
	}

	return "";
}

/**
 * Add a message to the conversation and place it into unread messages.
 * @param $idMessage : ID of the message to add.
 * @param $idConversation : ID of the conversation.
 * @return int : return an error code if an error occurred.
 */
function setUnreadMessage($idMessage, $idConversation) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO unread(idMessage, idUser) VALUES (:idMessage, :idUser)");

	foreach(getUsersInConversation($idConversation) as $user) {
		if($user['idUser'] != $_COOKIE['id']) {
			try {
				$request->execute(array(
					'idUser' => $user['idUser'],
					'idMessage' => $idMessage
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

/**
 * Set a message as read.
 * @param $idConversation : ID of the conversation of the message.
 * @param $idUser : ID of user concerned.
 * @return int : return an error code if an error occurred.
 */
function setReadMessage($idConversation, $idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("DELETE FROM unread WHERE idUser = :idUser AND idMessage IN (SELECT idMessage FROM Message WHERE idConversation = :idConversation)");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return "";
}

/**
 * Check if a user has an unread message in a specific conversation.
 * @param $idConversation : ID of the conversation to check.
 * @param $idUser : ID of the user to check.
 * @return mixed : number of unread messages, or an error code if an error occurred.
 */
function haveUnreadMessage($idConversation, $idUser) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT COUNT(*) FROM unread WHERE idUser = :idUser AND idMessage IN (SELECT idMessage FROM Message WHERE idConversation = :idConversation)");

	try {
		$request->execute(array(
			'idUser' => $idUser,
			'idConversation' => $idConversation
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetch()[0];
}

/**
 * Get the total number of unread messages for a specific user.
 * @param $idUser : ID of the user to check.
 * @return int|mixed : number of total unread messages.
 */
function allUnreadMessages($idUser) {
	$conversations = listConversations($idUser);
	$count = 0;

	foreach($conversations as $conversation)
		$count += haveUnreadMessage($conversation['idConversation'], $idUser);

	return $count;
}
