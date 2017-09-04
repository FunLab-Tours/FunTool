<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 11:10
 */

/*#########*/
/*MATERIALS*/
/*#########*/

function testMaterial($id, $labelMat, $codeMat)
{
    global $DB_DB;
    if($id == null){
        $request = $DB_DB->prepare("SELECT * FROM Materials WHERE labelMat LIKE :labelMat OR codeMat LIKE :codeMat");
        $request->execute(array(
            'labelMat' => $labelMat,
            'codeMat' => $codeMat
        ));
        $result = $request->fetchAll();
        return empty($result);
    }
    else{
        $request = $DB_DB->prepare("SELECT * FROM Materials WHERE (labelMat LIKE :labelMat OR codeMat LIKE :codeMat) AND idMat = :id");
        $request->execute(array(
            'labelMat' => $labelMat,
            'codeMat' => $codeMat,
            'id' => $id
        ));
        $result = $request->fetchAll();
        return empty($result);
    }
}

function addMaterial($labelMat, $codeMat, $priceMat, $docLink, $comment)
{
    if(!testMaterial(null, $labelMat, $codeMat))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO Materials (labelMat, codeMat, priceMat, docLink, comment, dateEntry) VALUES 
                                  (:labelMat, :codeMat, :priceMat, :docLink, :comment, :dateEntry)");
    try{
        $request->execute(array(
            'labelMat' => $labelMat,
            'codeMat' => $codeMat,
            'priceMat' => $priceMat,
            'docLink' => $docLink,
            'comment' => $comment,
            'dateEntry' => date_create("now")->format("Y-m-d H:i:s")
        ));
    }
    catch(Exception $e){
        return false;
    }

    return $DB_DB->lastInsertId();
}

function getMaterial($idMaterial)
{
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM Materials WHERE idMat = :id");

    try{
        $request->execute(array(
            'id' => $idMaterial
            ));
    }catch(Exception $e){}

    return $request->fetch();
}

function listMaterials()
{
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM Materials");

    try{
        $request->execute();
    }catch(Exception $e){}

    return $request->fetchAll();
}

function deleteMaterial($id)
{
    global $DB_DB;

    $request = $DB_DB->prepare("DELETE FROM Materials WHERE idMat = :id");
    try{
        $request->execute(array(
            'id' => $id
        ));
    }
    catch(Exception $e){}
}

function editMaterial($id, $labelMat, $codeMat, $priceMat, $docLink, $comment)
{
    if(!testMaterial($id, $labelMat, $codeMat))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE Materials SET labelMat = :labelMat, codeMat = :codeMat, priceMat = :priceMat, docLink = :docLink, comment = :comment WHERE idMat = :id");
    try{
        $request->execute(array(
            'labelMat' => $labelMat,
            'codeMat' => $codeMat,
            'priceMat' => $priceMat,
            'docLink' => $docLink,
            'comment' => $comment,
            'id' => $id
        ));
    }
    catch(Exception $e){
        return false;
    }
    return true;
}

/*########*/
/*COSTUNIT*/
/*########*/
function getCostUnitMat($id)
{
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM CostUnitMaterial WHERE idCostUnitMaterial IN (SELECT idCostUnitMaterial FROM Materials WHERE idMat = :id)");

    try{
        $request->execute(array(
            'id' => $id
            ));
    }catch(Exception $e){}

    return $request->fetch();
}

function assignCostUnit($id, $priceUnit, $unit)
{
    global $DB_DB;

    $idCostUnit = getIdCostUnitMat($priceUnit, $unit);

    $request= $DB_DB->prepare('UPDATE Materials SET idCostUnitMaterial = :idCostUnitMaterial WHERE idMat = :idMat');
    try{
        $request->execute(array(
            'idCostUnitMaterial' => $idCostUnit,
            'idMat' => $id
        ));
    }
    catch(Exception $e){}
}

function getIdCostUnitMat($priceUnit, $unit)
{
    global $DB_DB;
    //On vérifie si le tarif existe (si oui on récupère son id, sinon on le créé et on récupère son id
    $request = $DB_DB->prepare('SELECT idCostUnitMaterial FROM CostUnitMaterial WHERE costUnit LIKE :costUnit AND unit LIKE :unit');
    try {
        $request->execute(array(
            'costUnit' => $priceUnit,
            'unit' => $unit
        ));
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }

    if($request->rowCount() == 0)
        return addCostUnitMat($priceUnit, $unit);
    else
        return $request->fetch()[0];
}

function addCostUnitMat($priceUnit, $unit)
{
    global $DB_DB;

    $request = $DB_DB->prepare('INSERT INTO CostUnitMaterial(costUnit, unit) VALUES(:costUnit, :unit)');

    try {
        $request->execute(array(
            'costUnit' => $priceUnit,
            'unit' => $unit
        ));
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }

    return $DB_DB->lastInsertId();
}

/*#################*/
/*MATERIALINMACHINE*/
/*#################*/
function getMaterialsMachine($idMachine)
{
    global $DB_DB;

    $request = $DB_DB->prepare("SELECT * FROM Materials WHERE idMat IN (SELECT idMat FROM consume WHERE idMachine = :idMachine)");

    try{
        $request->execute(array(
            'idMachine' => $idMachine
        ));
    }catch(Exception $e){
        return null;
    }
    return $request->fetchAll();
}

function assignMaterialsToMachine($idMachine, $idsMat)
{
    global $DB_DB;
    if(!is_array($idsMat))
        $idsMat = array($idsMat);

    foreach ($idsMat as $idMat)
    {
        $request = $DB_DB->prepare("INSERT INTO consume (idMat, idMachine) VALUES (:idMat, :idMachine)");

        try{
            $request->execute(array(
                'idMat' => $idMat,
                'idMachine' => $idMachine
            ));
        }catch(Exception $e){}
    }
}

function unassignMaterialsFromMachine($idMachine)
{
    global $DB_DB;

    $request = $DB_DB->prepare("DELETE FROM consume WHERE idMachine = ".$idMachine);

    try{
        $request->execute();
    }catch(Exception $e){}
}

function reassignMaterialsToMachine($idMachine, $idsMat)
{
    unassignMaterialsFromMachine($idMachine);
    assignMaterialsToMachine($idMachine, $idsMat);
}