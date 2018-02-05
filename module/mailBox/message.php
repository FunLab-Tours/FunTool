<?php

/**
 * Send a message.
 * @param $idConversation : ID of the conversation.
 * @param $idUser : ID of the sender.
 * @param $textMessage : text of the message.
 * @return bool : ID of the message if it has been sent, or an error code if an error occurred.
 */
function createMessage($idConversation, $idUser, $textMessage) {
	global $DB_DB;
	$request = $DB_DB->prepare("INSERT INTO Message (textMessage, sentDateTime, idConversation, idUser) VALUES (:textMessage, :sentDateTime, :idConversation, :idUser)");

	try {
		$request->execute(array(
			'textMessage' => $textMessage,
			'idConversation' => $idConversation,
			'idUser' => $idUser,
			'sentDateTime' => date_create("now")->format("Y-m-d H:i:s")
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	$idMessage = $DB_DB->lastInsertId();
	setUnreadMessage($idMessage, $idConversation);

	return $idMessage;
}

/**
 * Get a message.
 * @param $id : ID of the message.
 * @return mixed : all attributes of the message, or an error code if an error occurred.
 */
function getMessage($id) {
	global $DB_DB;
	$request = $DB_DB->prepare("SELECT * FROM Message WHERE idMessage = :id");

	try {
		$request->execute(array(
			'id' => $id
		));
	}
	catch(Exception $e) {
		if($DEBUG_MODE)
			echo $e;
		return -2;
	}

	return $request->fetchAll()[0];
}
