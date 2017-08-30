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
            $result = $DB_DB->query('SELECT * FROM SoftwareSubcategory WHERE SubcatCode LIKE \''.$code.'\' OR SubcatLabel LIKE \''.$label.'\'')->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
        else
        {
            $result = $DB_DB->query('SELECT * FROM SoftwareSubcategory WHERE idSoftSubcat <> '.$id.' AND (SubcatCode LIKE \''.$code.'\' OR SubcatLabel LIKE \''.$label.'\')')->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
    }

    function listSubCategories($idCategory)
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SoftwareSubcategory WHERE idSoftCat = '.$idCategory)->fetchAll();
    }

    function getSubCategory($id)
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SoftWareSubcategory WHERE idsoftsubcat = '.$id)->fetchAll()[0];
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
        $DB_DB->query('DELETE FROM softwareInSubCategory WHERE  idSoftSubcat = '.$id);
        $DB_DB->query('DELETE FROM SoftwareSubcategory WHERE idSoftSubcat = '.$id);
    }

    /*################################*/
    /*########## CATEGORIES ##########*/
    /*################################*/

    function testInformationCategory($id, $code, $label)
    {
        global $DB_DB;
        if($id == null)
        {
            $result = $DB_DB->query('SELECT * FROM SoftwareCategory WHERE categoryCode = \''.$code.'\' OR categoryLabel LIKE \''.$label.'\'')->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
        else
        {
            $result = $DB_DB->query('SELECT * FROM SoftwareCategory WHERE idSoftCat <> \''.$id.'\' AND (categoryCode LIKE \''.$code.'\' OR categoryLabel LIKE \''.$label.'\')')->fetchAll();
            if(sizeof($result) != 0)
                return false;
            return true;
        }
    }

    function listCategories()
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SoftwareCategory')->fetchAll();
    }

    function getCategory($id)
    {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM SoftwareCategory WHERE idsoftcat = '.$id)->fetchAll()[0];
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
        $DB_DB->query('DELETE FROM SoftwareInCategory WHERE  idSoftcat = '.$id);
        $DB_DB->query('DELETE FROM SoftwareCategory WHERE idSoftcat = '.$id);
    }