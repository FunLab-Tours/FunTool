<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 14:16
 */


function listKnowledges($idUser)
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM know WHERE $idUser = ".$idUser)->fetchAll();
}

function assignKnowledges($idUser, $idSoftware, $level, $com)
{
    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO know  (idUser, idSoftware, knowledgeLevel, comment) 
                                        VALUES (:idUser, :idSoftware, :level, :com)");
    try{
        $request->execute(array(
            'idUser' => $idUser,
            'idSoftware' => $idSoftware,
            'level' => $level,
            'com' => $com
        ))->fetchAll();
    }
    catch(Exception $e){
        return false;
    }

    return true;
}

function knowledge($id, $level, $com)
{
    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE know
                                        SET (knowledgeLevel = :level, comment = :com)
                                        WHERE idUser = :id");
    try{
        $request->execute(array(
            'id' => $id,
            'level' => $level,
            'com' => $com
        ));
    }
    catch(Exception $e){
        return false;
    }

    return true;
}

function unassignKnowledge($idUser)
{
    global $DB_DB;
    $DB_DB->query('DELETE FROM know WHERE idUser = '.$idUser);
}