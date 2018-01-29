<?php

    function haveUserMaintenancedMachine($idMachine, $idUser, $message, $date)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT idMaintenance FROM Maintenance WHERE idMachine = :idMachine");
        try{
            $request->execute(array(
               'idMachine' => $idMachine
            ));
        }catch(Exception $e){
            throw $e;
        }

        $idMaintenance = $request->fetch()[0];

        $request = $DB_DB->prepare("INSERT INTO Historical (messageRepaire, idUser, dateMaintenance, idMaintenance) VALUES (:message, :idUser, :date, :idMaintenance)");
        try{
            $request->execute(array(
                'message' => $message,
                'idUser' => $idUser,
                'date' => $date,
                'idMaintenance' => $idMaintenance
            ));
        }catch(Exception $e){
            throw $e;
        }
    }

    function getMaintenancesHistorical($idMachine)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Historical WHERE idMaintenance IN (SELECT idMaintenance FROM Maintenance WHERE idMachine = :idMachine)");

        try{
            $request->execute(array(
               'idMachine' => $idMachine
            ));
        }catch(Exception $e){
            throw $e;
        }

        return $request->fetchAll()[0];
    }

?>