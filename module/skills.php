<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 10:32
 */

/*####################################*/
/*########## SKILLS TO USER ##########*/
/*####################################*/
function isUserSkilled($idSkill, $idUser)
{
    global $DB_DB;
    $result = $DB_DB->query('SELECT * FROM has WHERE idUser = '.$idUser.' AND idSkill = '.$idSkill)->fetchAll();
    if (sizeof($result) != 0)
        return false;
    return true;
}

function assignSkills($idUser, $idSkill, $skillLevel, $comment)
{
    global $DB_DB;

    if(!in_array(getSkill($idSkill), getSkillsListUser($idUser))) {
        $request = $DB_DB->prepare('INSERT INTO has (idUser, idSkill, skillLevel, comment) VALUES (:idUser, :idSkill, :skillLevel, :comment)');

        try {
            $request->execute(array(
                'idUser' => $idUser,
                'idSkill' => $idSkill,
                'skillLevel' => $skillLevel,
                'comment' => $comment
            ));
        } catch (Exception $e) {}
    }
}

function unassignSkill($idUser, $idSkill)
{
    global $DB_DB;
    $DB_DB->query('DELETE FROM has WHERE idUser = '.$idUser.' AND idSkill = '.$idSkill);
}

function getSkillUserInformation($idUser, $idSkill)
{
    global $DB_DB;
    return $DB_DB->query('SELECT * FROM has WHERE idUser = '.$idUser.' AND idSkill = '.$idSkill)->fetchAll()[0];
}

function editAssignment($idUser, $idSkill, $skillLevel, $comment)
{
    global $DB_DB;

        $request = $DB_DB->prepare('UPDATE has SET skillLevel = :skillLevel, comment = :comment WHERE idUser = :idUser AND idSkill = :idSkill');

        try {
            $request->execute(array(
                'idUser' => $idUser,
                'idSkill' => $idSkill,
                'skillLevel' => $skillLevel,
                'comment' => $comment
            ));
        } catch (Exception $e) {}
}

/*############################*/
/*########## SKILLS ##########*/
/*############################*/
function testSkill($idSkill, $skillName, $idSkillType)
{
    global $DB_DB;
    if($idSkill == null) {
        $result = $DB_DB->query('SELECT * FROM variousskills WHERE skillName LIKE \'' . $skillName . '\'')->fetchAll();
        if (sizeof($result) != 0)
            return false;
    }
    else{
        $result = $DB_DB->query('SELECT * FROM variousskills WHERE skillName LIKE \'' . $skillName . '\'
                                 AND idSkill <> '.$idSkill)->fetchAll();
        if (sizeof($result) != 0)
            return false;
    }

    $result = $DB_DB->query('SELECT * FROM SkillType WHERE idSkillType LIKE \'' . $idSkillType . '\'')->fetchAll();
    if (sizeof($result) == 0)
        return false;

    return true;
}
function getSkillsList()
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM VariousSkills")->fetchAll();
}

function getSkill($idSkill)
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM VariousSkills WHERE idSkill = ".$idSkill)->fetchAll();
}

function getSkillsListUser($idUser)
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM VariousSkills WHERE idSkill IN (
                                        SELECT idSkill FROM has WHERE idUser = ".$idUser."
                          )")->fetchAll();
}

function addSkill($skillName, $skillDescription, $idSkillType)
{
    if(!testSkill(null, $skillName, $idSkillType))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO VariousSkills (skillName, skillDescription, idSkillType)
                                VALUES (:skillName, :skillDescription, :idSkillType)");

    try{
        $request->execute(array(
            'skillName' => $skillName,
            'skillDescription' => $skillDescription,
            'idSkillType' => $idSkillType
        ));
        return true;
    }
    catch(Exception $e){
        return false;
    }
}

function editSkill($idSkill, $skillName, $skillDescription, $idSkillType)
{
    if(!testSkill($idSkill, $skillName, $idSkillType))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE VariousSkills SET skillName = :skillName, skillDescription = :skillDescription, idSkillType = :idSkillType
                                WHERE idSkill = :idSkill");

    try{
        $request->execute(array(
            'idSkill' => $idSkill,
            'skillName' => $skillName,
            'skillDescription' => $skillDescription,
            'idSkillType' => $idSkillType
        ));
        return true;
    }
    catch(Exception $e){
        return false;
    }
}

function deleteSkill($idSkill)
{
    global $DB_DB;

    //Delete in table 'has'
    $request = $DB_DB->prepare("DELETE FROM has WHERE idSkill = :idSkill");
    try{
        $request->execute(array(
            'idSkill' => $idSkill,
        ));
    }
    catch(Exception $e){}

    //Delete in table 'variousSkills'
    $request = $DB_DB->prepare("DELETE FROM variousskills WHERE idSkill = :idSkill");
    try{
        $request->execute(array(
            'idSkill' => $idSkill,
        ));
    }
    catch(Exception $e){}
}

/*###############################*/
/*########## SKILLTYPE ##########*/
/*###############################*/
function testSkillType($idSkillType, $skillTypeName)
{
    global $DB_DB;

    if($idSkillType == null) {
        $result = $DB_DB->query('SELECT * FROM SkillType WHERE skillTypeName LIKE \'' . $skillTypeName . '\'')->fetchAll();
        if (sizeof($result) != 0)
            return false;
    }
    else
    {
        $result = $DB_DB->query('SELECT * FROM SkillType WHERE skillTypeName LIKE \'' . $skillTypeName . '\'
                                 AND idSkillType <> '.$idSkillType)->fetchAll();
        if (sizeof($result) != 0)
            return false;
    }
    return true;
}

function getSkillType($idSkillType)
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM SkillType WHERE idSkillType = ".$idSkillType)->fetchAll()[0];
}
function getSkillsTypeList()
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM SkillType")->fetchAll();
}

function addSkillType($skillTypeName)
{
    if(!testSkillType(null, $skillTypeName))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO SkillType (skillTypeName) VALUES (:skillTypeName)");

    try{
        $request->execute(array(
            'skillTypeName' => $skillTypeName
        ));
        return true;
    }catch(Exception $e)
    {
        return false;
    }
}

function editSkillType($idSkillType, $skillTypeName)
{
    if(!testSkillType($idSkillType, $skillTypeName))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE SkillType SET skillTypeName = :skillTypeName
                                WHERE idSkillType = :idSkillType");

    try{
        $request->execute(array(
            'idSkillType' => $idSkillType,
            'skillTypeName' => $skillTypeName
        ));
        return true;
    }catch(Exception $e)
    {
        return false;
    }
}

function deleteSkillType($idSkillType)
{
    global $DB_DB;

    //The delete can be effective only if it is not use in a variousSkill
    $request = $DB_DB->prepare("DELETE FROM skillType WHERE idSkillType = :idSkillType");
    try{
        $request->execute(array(
            'idSkillType' => $idSkillType,
        ));
    }
    catch(Exception $e){}
}