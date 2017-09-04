<?php
    /**
     * Created by PhpStorm.
     * User: thiba
     * Date: 21/08/2017
     * Time: 11:06
     */

    /*###################################*/
    /*########## SUBCATEGORIES ##########*/
    /*###################################*/

    function testInformationSubCategory($id, $code, $label)
    {
        global $DB_DB;
        if($id == null)
        {
            $request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE SubcatCode LIKE :code OR SubcatLabel LIKE :label");

            try{
                $request->execute(array(
                    'code' => $code,
                    'label' =>$label
            ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
        else
        {
            $request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE idSoftSubcat <> :id AND (SubcatCode LIKE :code OR SubcatLabel LIKE :label)");

            try{
                $request->execute(array(
                    'code' => $code,
                    'label' => $label,
                    'id' => $id
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
    }

    function listSubCategories($idCategory)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftWareSubCategory WHERE idSoftCat = :idCategory");

        try{
            $request->execute(array(
                'idCategory' => $idCategory
            ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getSubCategory($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftWareSubCategory WHERE idsoftsubcat = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
        return $request->fetchAll()[0];
    }

    function addSubCategory($idCat, $code, $label)
    {
        if(!testInformationSubCategory(null, $code, $label))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO SoftwareSubcategory  (idSoftCat, SubcatCode, SubcatLabel) 
                                    VALUES (:idCat, :code, :label)');
        try{
            $request->execute(array(
                'idCat' => $idCat,
                'code' => $code,
                'label' => $label
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function editSubCategory($id, $code, $label)
    {
        if(!testInformationSubCategory($id, $code, $label))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('UPDATE SoftwareSubcategory
                                    SET SubcatCode = :code, SubcatLabel = :label
                                    WHERE idSoftSubcat = :id');
        try{
            $request->execute(array(
                'id' => $id,
                'code' => $code,
                'label' => $label
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function deleteSubCategory($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("DELETE FROM softwareInSubCategory WHERE  idSoftSubcat = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
        $request = $DB_DB->prepare('DELETE FROM softwaresubcategory WHERE idSoftSubcat = :id');

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
    }

    /*################################*/
    /*########## CATEGORIES ##########*/
    /*################################*/

    function testInformationCategory($id, $code, $label)
    {
        global $DB_DB;
        if($id == null)
        {
            $request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE categoryCode = :code OR categoryLabel LIKE :label");

            try{
                $request->execute(array(
                    'code' => $code,
                    'label' => $label
            ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
        else
        {
            $request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE idSoftCat <> :id AND (categoryCode LIKE :code OR categoryLabel LIKE :label)");

            try{
                $request->execute(array(
                    'id' => $id,
                    'code' => $code,
                    'label' =>$label
            ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
    }

    function listCategories()
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftWareCategory");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getCategory($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftWareCategory WHERE idsoftcat = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}

        return $request->fetchAll()[0];
    }

    function addCategory($code, $label)
    {
        if(!testInformationCategory(null, $code, $label))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO SoftwareCategory  (categoryCode, categoryLabel) 
                                        VALUES (:code, :label)');
        try{
            $request->execute(array(
                'code' => $code,
                'label' => $label
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function editCategory($id, $code, $label)
    {
        if(!testInformationCategory($id, $code, $label))
            return false;
        global $DB_DB;

        $request = $DB_DB->prepare('UPDATE SoftwareCategory
                                        SET categoryCode = :code, categoryLabel = :label
                                        WHERE idSoftCat = :id');
        try{
            $request->execute(array(
                'id' => $id,
                'code' => $code,
                'label' => $label
            ));
        }
        catch(Exception $e){
            return false;
        }

        return true;
    }

    function deleteCategory($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("DELETE FROM softwareInCategory WHERE  idSoftcat = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}

        $request = $DB_DB->prepare("DELETE FROM softwareCategory WHERE idSoftcat = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
    }