<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/08/2017
 * Time: 15:24
 */

function createMessage($idConversation, $idUser, $textMessage)
{
    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO Message (textMessage, sentDateTime, idConversation, idUser) VALUES (:textMessage, :sentDateTime, :idConversation, :idUser)");
    try{
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
    var_dump("r=trux");
    setUnreadMessage($idMessage, $idConversation);
    var_dump("mp");

    return $idMessage;
}

function getMessage($id)
{
    global $DB_DB;

    $request = $DB_DB->prepare("SELECT * FROM Message WHERE idMessage = :id");

    try{
        $request->execute(array(
            'id' => $id
            ));
    }catch(Exception $e){}

    return $request->fetchAll()[0];
}