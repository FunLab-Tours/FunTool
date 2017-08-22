<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/08/2017
 * Time: 14:16
 */

/*##############################*/
/*########## SOFTWARE ##########*/
/*##############################*/

function testSoftware($id, $name)
{
    global $DB_DB;
    if($id == null)
    {
        $request = $DB_DB->prepare("SELECT * FROM Software WHERE softwareName = :name");
        try{
            $result = $request->execute(array(
                'softwareName' => $name
            ))->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
    else
    {
        $request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE idSoftCat <> :id AND softwareName = :name");
        try{
            $result = $request->execute(array(
                'id' => $id,
                'softwareName' => $name
            ))->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }
}

function listSoftware()
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM Software")->fetchAll();
}

function getSoftWare($id)
{
    global $DB_DB;
    return $DB_DB->query("SELECT * FROM Software WHERE idsoftware = ".$id)->fetchAll()[0];
}

function addSoftware($name, $description, $categories, $subCategories)
{
    if(!testKnowledge(null, $name))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("INSERT INTO Software  (SoftwareName, softwareDescription) 
                                        VALUES (:name, :description)");
    try{
        $request->execute(array(
            'name' => $name,
            'description' => $description
        ));
    }
    catch(Exception $e){
        return false;
    }

    assignCategoriesToSoftWare($DB_DB->lastInsertId(), $categories);
    assignSubCategoriesToSoftWare($DB_DB->lastInsertId(), $subCategories);

    return true;
}

function editSoftware($id, $name, $description, $categories, $subCategories)
{
    if(!testKnowledge($id, $name))
        return false;

    global $DB_DB;

    $request = $DB_DB->prepare("UPDATE SoftwareCategory
                                        SET (SoftwareName = :name, softwareDescription = :description)
                                        WHERE idSoftware = :id");
    try{
        $request->execute(array(
            'id' => $id,
            'name' => $name,
            'description' => $description
        ));
    }
    catch(Exception $e){
        return false;
    }

    assignCategoriesToSoftWare($id, $categories);
    assignSubCategoriesToSoftWare($id, $subCategories);

    return true;
}

function deleteSoftware($id)
{
    global $DB_DB;
    $DB_DB->query('DELETE FROM know WHERE  idSoftware = '.$id);
    $DB_DB->query('DELETE FROM SoftwareInCategory WHERE  idSoftware = '.$id);
    $DB_DB->query('DELETE FROM SoftwareInSubCategory WHERE  idSoftware = '.$id);
    $DB_DB->query('DELETE FROM software WHERE idSoftware = '.$id);
}

/*########################################*/
/*########## SOFTWAREINCATEGORY ##########*/
/*########################################*/

function getSoftwareCategories($id)
{
    global $DB_DB;
    return $DB_DB->query('SELECT * FROM SoftwareCategory WHERE idSoftCat IN (
                    SELECT idSoftCat FROM SoftwareInCategory WHERE idSoftWare = '.$id.')')->fetchAll();
}

function assignCategoriesToSoftWare($idSoftware, $categories)
{
    global $DB_DB;

    /*On supprime d'abord les anciens liens de SoftwareInCategory*/
    unassignCategoriesFromSoftWare($idSoftware);

    /*Puis on assigne les nouveaux*/
    foreach ($categories as $category)
    {
        $request = $DB_DB->prepare('INSERT INTO SoftwareInCategory (idSoftware, idSoftCat) VALUES (:idSoftware, :idSoftCat)');
        try{
            $request->execute(array(
                'idSoftware' => $idSoftware,
                'idSoftCat' => $category['idSoftCat']
            ));
        }
        catch(Exception $e){
            return false;
        }
    }
}

function unassignCategoriesFromSoftWare($idSoftware)
{
    global $DB_DB;

    $request = $DB_DB->prepare('DELETE FROM SoftwareInCategory WHERE idSoftware = :id');
    try {
        $request->execute(array(
            'id' => $idSoftware
        ));
    } catch (Exception $e) {
        return false;
    }
}

/*########################################*/
/*########## SOFTWAREINSUBCATEGORY ##########*/
/*########################################*/

function getSoftwareSubCategories($id)
{
    global $DB_DB;
    return $DB_DB->query('SELECT * FROM SoftwareCategory WHERE idSoftCat IN (
                    SELECT idSoftCat FROM SoftwareInCategory WHERE idSoftWare = '.$id.')')->fetchAll();
}

function assignSubCategoriesToSoftWare($idSoftware, $subCategories)
{
    global $DB_DB;

    /*On supprime d'abord les anciens liens de SoftwareInSubCategory*/
    unassignSubCategoriesFromSoftWare($idSoftware);

    /*Puis on assigne les nouveaux*/
    foreach ($subCategories as $subCategory)
    {
        $request = $DB_DB->prepare('INSERT INTO SoftwareInSubCategory (idSoftware, idSoftSubcat) VALUES (:idSoftware, :idSoftSubcat)');
        try{
            $request->execute(array(
                'idSoftware' => $idSoftware,
                'idSoftSubcat' => $subCategory['idSoftSubcat']
            ));
        }
        catch(Exception $e){
            return false;
        }
    }
}

function unassignSubCategoriesFromSoftWare($idSoftware)
{
    global $DB_DB;

    $request = $DB_DB->prepare('DELETE FROM SoftwareInSubCategory WHERE idSoftware = :id');
    try{
        $request->execute(array(
            'id' => $idSoftware
        ));
    }
    catch(Exception $e){
        return false;
    }
}