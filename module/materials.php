<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 30/08/2017
 * Time: 11:10
 */

function testMaterial($id, $labelMat, $codeMat)
{
    global $DB_DB;
    if($id == null){
        $result = $DB_DB->query("SELECT * FROM Materials WHERE labelMat LIKE '".$labelMat."' OR codeMat LIKE '".$codeMat."'")->fetchAll();
        return empty($result);
    }
    else{
        $result = $DB_DB->query("SELECT * FROM Materials WHERE labelMat LIKE ('".$labelMat."' OR codeMat LIKE '".$codeMat."') AND idMat <> ".$id)->fetchAll();
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
    return $DB_DB->query("SELECT * FROM Materials WHERE idMat = ".$idMaterial)->fetch();
}

function listMaterials()
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM Materials")->fetchAll();
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

    $request = $DB_DB->prepare("UPDATE Materials SET labelMat = :labelMat, codeMat = :codeMat, priceMat = :priceMat, docLink = :docLink, comment = :comment");
    try{
        $request->execute(array(
            'labelMat' => $labelMat,
            'codeMat' => $codeMat,
            'priceMat' => $priceMat,
            'docLink' => $docLink,
            'comment' => $comment,
        ));
    }
    catch(Exception $e){
        return false;
    }

    return true;
}