<?php

    function testSoftware($id, $name)
    {
        global $DB_DB;
        if($id == null)
        {
            $request = $DB_DB->prepare("SELECT * FROM Software WHERE softwareName LIKE :name");

            try{
                $request->execute(array(
                    'name' => $name
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
        else
        {
            $request = $DB_DB->prepare("SELECT * FROM Software WHERE idSoftware <> :id AND softwareName LIKE :name");

            try{
                $request->execute(array(
                    'id' => $id,
                    'name' => $name
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
            return true;
        }
    }

    function listSoftware()
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM Software");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getSoftWare($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM Software WHERE idsoftware = :id");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}

        return $request->fetchAll()[0];
    }

    function addSoftware($name, $description, $categories, $subCategories)
    {
        if(!testSoftware(null, $name))
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

        $id = $DB_DB->lastInsertId();
        assignCategoriesToSoftWare($id, $categories);
        assignSubCategoriesToSoftWare($id, $subCategories);

        return true;
    }

    function editSoftware($id, $name, $description, $categories, $subCategories)
    {
        if(!testSoftware($id, $name))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare("UPDATE Software
                                            SET SoftwareName = :name, softwareDescription = :description
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
        $request = $DB_DB->prepare("DELETE FROM know WHERE  idSoftware = :id");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}
        $request = $DB_DB->prepare("DELETE FROM SoftwareInCategory WHERE  idSoftware = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
        $request = $DB_DB->prepare("DELETE FROM SoftwareInSubCategory WHERE  idSoftware = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
        $request = $DB_DB->prepare("DELETE FROM software WHERE  idSoftware = :id");

        try{
            $request->execute(array(
                'id' => $id
            ));
        }catch(Exception $e){}
    }

    // Software in category.

    function getSoftwareCategories($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftwareCategory WHERE idSoftCat IN (
                        SELECT idSoftCat FROM SoftwareInCategory WHERE idSoftWare = :id)");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function assignCategoriesToSoftWare($idSoftware, $categories)
    {
        global $DB_DB;

        // First, we delete old links from SoftwareInCategory.
        unassignCategoriesFromSoftWare($idSoftware);

        // And then we set the new ones.
        foreach ($categories as $category)
        {
            $request = $DB_DB->prepare('INSERT INTO SoftwareInCategory (idSoftware, idSoftCat) VALUES (:idSoftware, :idSoftCat)');
            try{
                $request->execute(array(
                    'idSoftware' => $idSoftware,
                    'idSoftCat' => $category
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

    // Software in subcategory.

    function getSoftwareSubCategories($id)
    {
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM SoftwareSubCategory WHERE idSoftSubcat IN (
                        SELECT idSoftSubcat FROM SoftwareInSubCategory WHERE idSoftWare = :id)");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
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
                    'idSoftSubcat' => $subCategory
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

?>