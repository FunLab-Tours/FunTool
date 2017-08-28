<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 24/08/2017
 * Time: 15:24
 */

function createConversation($idUsers, $name)
{
    global $DB_DB;

    if(sizeof($idUsers) == 1)
        $name = null;

    $request = $DB_DB->prepare("INSERT INTO Conversation (name, startDateTime) VALUES (:name, :startDateTime)");
    try{
        $request->execute(array(
            'name' => $name,
            'startDateTime' => date_create("now")->format("Y-m-d H:i:s")
        ));
    }
    catch(Exception $e){
        return false;
    }

    $idConversation = $DB_DB->lastInsertId();

    foreach ($idUsers as $idUser)
    {
        $request = $DB_DB->prepare("INSERT INTO userInConversation (idUser, idConversation) VALUES (:idUser, :idConversation)");
        try{
            $request->execute(array(
                'idUser' => $idUser,
                'idConversation' => $idConversation
            ));
        }
        catch(Exception $e){
            return false;
        }
    }

    $request = $DB_DB->prepare("INSERT INTO userInConversation (idUser, idConversation) VALUES (:idUser, :idConversation)");
    try{
        $request->execute(array(
            'idUser' => $_COOKIE['id'],
            'idConversation' => $idConversation
        ));
    }
    catch(Exception $e){
        return false;
    }

    return $idConversation;
}

function listConversations($idUser)
{
    global $DB_DB;

    return $DB_DB->query("SELECT * FROM Conversation WHERE idConversation IN (SELECT idConversation FROM userInConversation WHERE idUser = ".$idUser.")")->fetchAll();
}

function getConversation($idConversation)
{
    global $DB_DB;

    return $DB_DB->query("SELECT * FROM Conversation WHERE idConversation = ".$idConversation)->fetchAll()[0];
}

function getMessages($idConversation)
{
    global $DB_DB;

    return $DB_DB->query("SELECT * FROM Message WHERE idConversation = ".$idConversation." ORDER BY sentDateTime")->fetchAll();
}

function getUsersInConversation($idConversation)
{
    global $DB_DB;

    return $DB_DB->query("SELECT * FROM User WHERE idUser IN (SELECT idUser FROM userInConversation WHERE idConversation = ".$idConversation.")")->fetchAll();
}

/*Create a new conversation if the conversation don't already exist*/
function searchForConversation($idUser, $idRecipient)
{
    global $DB_DB;
    $idConversations = $DB_DB->query("SELECT idConversation FROM userInConversation WHERE idUser = ".$idUser)->fetch();
    $bad_ids = [];
    foreach ($idConversations as $idConversation)
    {
        $userNumber = $DB_DB->query("SELECT COUNT(idUser) FROM userInConversation WHERE idConversation = ".$idConversation);
        if($userNumber > 2)
            $bad_ids = array_push($bad_ids, $idConversation);
    }
    $idConversations = array_diff($idConversations, $bad_ids);

    foreach ($idConversations as $idConversation)
    {
        $conv = $DB_DB->query("SELECT * FROM userInConversation WHERE idUser = ".$idRecipient." AND idConversation = ".$idConversation)->fetchAll()[0];
        if(!empty($conv))
            return $idConversation;
    }

    return createConversation(array($idRecipient), null);
}

function countUserInConversation($idUser)
{
    global 
}
