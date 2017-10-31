<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 14/09/2017
 * Time: 16:43
 */

function createMaintenance($name, $timeBetweenMaintenances, $idMachine)
{
    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO Maintenance (nameMaintenance, timeBetweenMaintenances, idMachine) VALUES (:name, :timeBetweenMaintenances, :idMachine)");

    try{
        $request->execute(array(
           'name' => $name,
           'timeBetweenMaintenances' => $timeBetweenMaintenances,
           'idMachine' => $idMachine
        ));
    }catch (Exception $e){
        throw $e;
    }

    return $DB_DB->lastInsertedId();
}

function editMaintenance($idMaintenance, $name, $timeBetweenMaintenances)
{
    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE Maintenance SET nameMaintenance = :nameMaintenance, timeBetweenMaintenances = :timeBetweenMaintenance WHERE idMaintenance = :idMaintenance");

    try{
        $request->execute(array(
            'name' => $name,
            'timeBetweenMaintenances' => $timeBetweenMaintenances,
            'idMaintenance' => $idMaintenance
        ));
    }catch (Exception $e){
        throw $e;
    }
}

function deleteMaintenance($idMaintenance)
{
    global $DB_DB;

    $request = $DB_DB->prepapre("DELETE FROM Maintenance WHERE idMaintenant = :idMaintenance");

    try{
        $request->execute(array(
            'idMaintenance' => $idMaintenance
        ));
    }catch(Exception $e){
        throw  $e;
    }
}

function getMaintenance($idMaintenance)
{
    global $DB_DB;

    $request = $DB_DB->prepare("SELECT * FROM Maintenance WHERE idMaintenance = :idMaintenance");

    try{
        $request->execute(array(
           'idMaintenance' => $idMaintenance
        ));
    }catch(Exception $e){
        throw  $e;
    }

    return $request->fetchAll()[0];
}

function listMaintenances($idMachine)
{
    global $DB_DB;

    $request = $DB_DB->prepare("SELECT * FROM Maintenance WHERE idMaintenance IN (SELECT idMaintenance FROM repair WHERE idMachine = :idMachine);");

    try{
        $request->execute(array(
           'idMachine' => $idMachine
        ));

        return $request->fetchAll();
    }catch(Exception $e){
        throw $e;
    }
}

function remainTimeMaintenances($idMaintenance)
{
    global $DB_DB;

    //Select the last maintenance date
    $request = $DB_DB->prepare("SELECT dateMaintenance FROM Historical WHERE idHistorical = MAX(SELECT idHistorical FROM Historical WHERE idMaintenance = :idMaintenance)");
    try{
        $request->execute(array(
           'idMaintenance' => $idMaintenance
        ));
    }catch(Exception $e){
        throw $e;
    }
    $result = $request->fetch();

    //Select all duration since the last maintenance
    if(empty($result)){
        $request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");
        try{
            $request->execute(array(
                'idMaintenance' => $idMaintenance
            ));
        }catch(Exception $e){
            throw $e;
        }
    }
    else{
        $request = $DB_DB->prepare("SELECT duration FROM MachineUseForm WHERE dateUseForm >= :dateMaintenance AND idMachine IN (SELECT idMachine FROM Maintenance WHERE idMaintenance = :idMaintenance)");
        try{
            $request->execute(array(
                'idMaintenance' => $idMaintenance,
                'dateMaintenance' => $result[0]
            ));
        }catch(Exception $e){
            throw $e;
        }
    }
    $result = $request->fetch();
    $duration = 0;

    //Add theses duration and calcul the remaining time
    for($count = 0; $count < sizeof($result); $count++)
        $duration += $result[$count];

    $request = $DB_DB->prepare("SELECT timeBetweenMaintenances FROM Maintenance WHERE idMaintenance = :idMaintenance");
    try{
        $request->execute(array(
            'idMaintenance' => $idMaintenance
        ));
    }catch(Exception $e){
        throw $e;
    }

    $remainingTime = $request->fetch[0] - $duration;
    if($remainingTime < 0)
        return 0;
    else return $remainingTime;
}

function listMaintenancesToBeDone()
{
    global $DB_DB;

    $maintenances = $DB_DB->query("SELECT * FROM Maintenance")->fetchAll();

    $toBeDone = array();

    foreach ($maintenances as $maintenance) {
        if(remainTimeMaintenances($maintenance['idMaintenance']) != 0)
            array_push($toBeDone, $maintenance);
    }

    return $toBeDone;
}