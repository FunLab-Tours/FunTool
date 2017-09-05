<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 22/08/2017
 * Time: 15:06
 */

function searchForUser($pattern)
{
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM User WHERE (firstName LIKE :pattern OR name LIKE :pattern
                            OR login LIKE :pattern) AND idUser <> :id");

    try{
        $request->execute(array(
            'id' => $_COOKIE['id'],
            'pattern' => $pattern
            ));
    }catch(Exception $e){}

    return $request->fetchAll();
}

function searchForRoles($roles)
{
    global $DB_DB;
    $result = array();
    foreach ($roles as $role) {
        if($role != "") {
            $request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM userRole WHERE idRole = :role) ORDER BY login");

            try {
                $request->execute(array(
                    'role' => $role
                ));
            } catch (Exception $e) {}

            array_push($result, $request->fetchAll());
        }
    }
    return $result[0];
}

function searchForSkills($skills)
{
    global $DB_DB;
    $result = array();
    foreach ($skills as $skill) {
        if($skill != "") {
            $request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM has WHERE idSkill = :skill ORDER BY skillLevel)");

            try{
                $request->execute(array(
                    'skill' => $skill
            ));
            }catch(Exception $e){}

            array_push($result, $request->fetchAll());
        }
    }
    return $result[0];
}

function searchForKnowledges($knowledges)
{
    global $DB_DB;
    $result = array();
    foreach ($knowledges as $knowledge) {
        if($knowledge != "") {
            $request = $DB_DB->prepare("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM know WHERE idsoftware = :knowledge ORDER BY knowledgeLevel)");

            try{
                $request->execute(array(
                    'knowledge' => $knowledge
            ));
            }catch(Exception $e){}

            array_push($result, $request->fetchAll());
        }
    }
    return $result[0];
}
