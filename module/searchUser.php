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
    return $DB_DB->query("SELECT * FROM User WHERE (firstName LIKE '".$pattern."' OR name LIKE '".$pattern."'
                            OR login LIKE '".$pattern."') AND idUser <> ".$_COOKIE['id'])->fetchAll();
}

function searchForRoles($roles)
{
    global $DB_DB;
    $result = array();
    foreach ($roles as $role) {
        if($role != "")
            array_push($result, $DB_DB->query("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM userRole WHERE idRole = ".$role.") ORDER BY login")->fetchAll());
    }
    return $result[0];
}

function searchForSkills($skills)
{
    var_dump($skills);
    global $DB_DB;
    $result = array();
    foreach ($skills as $skill) {
        if($skill != "")
            array_push($result, $DB_DB->query("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM has WHERE idSkill = ".$skill." ORDER BY skillLevel)")->fetchAll());
    }
    return $result[0];
}

function searchForKnowledges($knowledges)
{
    global $DB_DB;
    $result = array();
    foreach ($knowledges as $knowledge) {
        if($knowledge != "")
            array_push($result, $DB_DB->query("SELECT * FROM User WHERE idUser IN (
                          SELECT idUser FROM know WHERE idsoftware = " . $knowledge . " ORDER BY knowledgeLevel)")->fetchAll());
    }
    return $result[0];
}
