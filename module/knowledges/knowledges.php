<?php

    function listKnowledges($idUser)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM know WHERE idUser = :id");

        try{
            $request->execute(array(
                'id' => $idUser
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function listIdSoftwareFromKnowledge($idUser)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT idSoftware FROM know WHERE idUser = :idUser");

        try{
            $request->execute(array(
                'idUser' => $idUser
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
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
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function editKnowledge($idUser, $idSoft, $level, $com)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("UPDATE know SET knowledgeLevel = :level, comment = :com
                                            WHERE idSoftware = :idSoft AND idUser = :idUser");
        try{
            $request->execute(array(
                'idSoft' => $idSoft,
                'idUser' => $idUser,
                'level' => $level,
                'com' => $com
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function unassignKnowledge($idSoftware)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("DELETE FROM know WHERE idSoftware = :idSoftware");

        try{
            $request->execute(array(
                'idSoftware' => $idSoftware
                ));
        }catch(Exception $e){}
    }

?>