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

    array_push($idUsers, $_COOKIE['id']);
    addUsersToConversation($idConversation, $idUsers);

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
    $idConversations = $DB_DB->query("SELECT idConversation FROM userInConversation WHERE idUser = ".$idUser)->fetchAll();

    foreach ($idConversations as $idConversation)
    {
        if(countUserInConversation($idConversation['idConversation']) == 2){
            $conv = $DB_DB->query("SELECT * FROM userInConversation WHERE idUser = ".$idRecipient." AND idConversation = ".$idConversation['idConversation'])->fetchAll();
            if(!empty($conv))
                return $idConversation['idConversation'];
        }
    }

    return createConversation(array($idRecipient), null);
}

function countUserInConversation($idConversation)
{
    global $DB_DB;
    return $DB_DB->query("SELECT COUNT(idUser) FROM userInConversation WHERE idConversation = ".$idConversation)->fetch()['COUNT(idUser)'];
}

function changeConversationName($idConversation, $name)
{
    global $DB_DB;
    $DB_DB->query("UPDATE Conversation SET name = '".$name."' WHERE idConversation = ".$idConversation);
}

function addUsersToConversation($idConversation, $idUsers)
{
    global $DB_DB;
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
}

function removeUsersFromConversation($idConversation, $idUsers)
{
    global $DB_DB;
    foreach($idUsers as $idUser)
    {
        $request = $DB_DB->prepare("DELETE FROM userInConversation WHERE idUser = :idUser AND idConversation = :idConversation");
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
}

function setUnreadMessage($idMessage, $idConversation)
{
    global $DB_DB;
    foreach (getUsersInConversation($idConversation) as $user)
    {
        if($user['idUser'] != $_COOKIE['id']){
            $request = $DB_DB->prepare("INSERT INTO unread (idMessage, idUser) VALUES (:idMessage, :idUser)");
            try {
                $request->execute(array(
                    'idUser' => $user['idUser'],
                    'idMessage' => $idMessage
                ));
            } catch (Exception $e) {
                return false;
            }
        }
    }
    return true;
}

function setReadMessage($idConversation, $idUser)
{
    global $DB_DB;
    $request = $DB_DB->prepare("DELETE FROM unread WHERE idUser = :idUser AND idMessage IN (SELECT idMessage FROM Message WHERE idConversation = :idConversation)");
    try {
        $request->execute(array(
            'idUser' => $idUser,
            'idConversation' => $idConversation
        ));
    } catch (Exception $e) {
        return false;
    }
    return true;
}

function haveUnreadMessage($idConversation, $idUser)
{
    global $DB_DB;
    return $DB_DB->query("SELECT COUNT(*) FROM unread WHERE idUser = ".$idUser." AND idMessage IN (SELECT idMessage FROM Message WHERE idConversation = ".$idConversation.")")->fetch()[0];
}

function allUnreadMessages($idUser)
{
    global $DB_DB;
    $conversations = listConversations($idUser);
    $count = 0;

    foreach($conversations as $conversation)
        $count += haveUnreadMessage($conversation['idConversation'], $idUser);

    return $count;
}