<?php

/**
 * Send a message.
 * @param $idConversation : ID of the conversation.
 * @param $idUser : ID of the sender.
 * @param $textMessage : text of the message.
 * @return bool : true if the message has been sent, false else.
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
		return false;
	}

	$idMessage = $DB_DB->lastInsertId();
	setUnreadMessage($idMessage, $idConversation);

	return $idMessage;
}

/**
 * Get a message.
 * @param $id : ID of the message.
 * @return mixed : all attributes of the message.
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
	}

	return $request->fetchAll()[0];
}
