<?php

    // User.

    function assignRolesToUser($idUser, $idsRoles)
    {
        // We delete old ones and set new ones.
        global $DB_DB;

        $request = $DB_DB->prepare('DELETE FROM userRole WHERE idUser = :id');
        try{
            $request->execute(array(
                'id' => $idUser,
            ));
        }
        catch(Exception $e){}

        foreach ($idsRoles as $idRole) {
            $request = $DB_DB->prepare('INSERT INTO userRole (idRole, idUser) VALUES (:idRole, :idUser)');
            try {
                $request->execute(array(
                    'idUser' => $idUser,
                    'idRole' => $idRole
                ));
            } catch (Exception $e) {
            }
        }
    }

    // Roles.

    function testValuesRole($id, $name)
    {
        global $DB_DB;
        if($id == null)
        {
            $request = $DB_DB->prepare("SELECT * FROM Role WHERE roleName LIKE :name");

            try{
                $request->execute(array(
                    'name' => $name
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
        }
        else
        {
            $request = $DB_DB->prepare("SELECT * FROM Role WHERE roleName LIKE :name
                                     AND idRole <> :id");

            try{
                $request->execute(array(
                    'id' => $id,
                    'name' => $name
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
        }
        return true;
    }

    function getUserRoles($id)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Role WHERE idRole IN (SELECT idRole FROM userRole WHERE idUser = :id)");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getRolesList()
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Role");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function addRole($name, $description, $rights)
    {
        if(!testValuesRole(null, $name))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO Role (roleName, roleDescription) VALUES (:roleName, :roleDescription)');

        try{
            $request->execute(array(
                'roleName' => $name,
                'roleDescription' => $description
            ));
        }
        catch(Exception $e){}

        $idRole = $DB_DB->lastInsertId();

        // Add links with rights.
        if($rights != null)
            foreach($rights as $right) {
                $request = $DB_DB->prepare('INSERT INTO according (idRole, idRights) VALUES (:idRole, :idRights)');

                try {
                    $request->execute(array(
                        'idRole' => $idRole,
                        'idRights' => $right
                    ));
                } catch (Exception $e) {
                }
            }
        return true;
    }


    function editRole($id, $name, $description, $rights)
    {
        if(!testValuesRole($id, $name))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('UPDATE Role SET roleName = :roleName, 
                                                      roleDescription = :roleDescription
                                    WHERE idRole= :id');
        var_dump($request);
        try{
            $request->execute(array(
                'id' => $id,
                'roleName' => $name,
                'roleDescription' => $description
            ));
        }
        catch(Exception $e){
            return false;
        }

        // For according relation we delete all and add new ones.
        $request = $DB_DB->prepare('DELETE FROM according WHERE idRole = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}

        var_dump($rights);

        // Add links with rights.
        if($rights != null)
            foreach($rights as $right) {
                $request = $DB_DB->prepare('INSERT INTO according (idRole, idRights) VALUES (:idRole, :idRights)');

                try {
                    $request->execute(array(
                        'idRole' => $id,
                        'idRights' => $right
                    ));
                } catch (Exception $e){
                    return false;
                }
            }
        return true;
    }

    function deleteRole($id)
    {
        global $DB_DB;
        // Delete the key in according.
        $request = $DB_DB->prepare('DELETE FROM according WHERE idRole = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}

        // Delete the key in userRole.
        $request = $DB_DB->prepare('DELETE FROM userRole WHERE idRole = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}

        // Then delete the role.
        $request = $DB_DB->prepare('DELETE FROM Role WHERE idRole = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}
    }

    // Rights.

    function testValuesRights($id, $title, $path)
    {
        global $DB_DB;
        if($id == null)
        {
            $request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsTitle LIKE :title");

            try{
                $request->execute(array(
                    'title' => $title
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;

            $request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsPath LIKE :path");

            try{
                $request->execute(array(
                    'path' => $path
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
        }
        else
        {
            $request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsTitle LIKE :title
                                     AND idRights <> :id");

            try{
                $request->execute(array(
                    'id' => $id,
                    'title' => $title
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;

            $request = $DB_DB->prepare("SELECT * FROM Rights WHERE rightsPath LIKE :path
                                        AND idRights <> :id");

            try{
                $request->execute(array(
                    'id' => $id,
                    'path' => $path
                ));
            }catch(Exception $e){}
            if($request->rowCount() != 0)
                return false;
        }
        return true;
    }

    function getRights($id)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Rights WHERE idRights IN (SELECT idRights FROM according WHERE idRole = :id");

        try{
            $request->execute(array(
                'id' => $id
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getRightsList()
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Rights");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getRightsRoleList($idRole)
    {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Rights WHERE idRights IN (SELECT idRights FROM according WHERE idRole = :idRole)");

        try{
            $request->execute(array(
                'idRole' => $idRole
                ));
        }catch(Exception $e){}

        return $request->fetchAll();
    }

    function getRightsListWithRoles($roles)
    {
        // Return the list of all rights attached to the list of roles passed in parameters. Doesn't count double rights.
        $list = array();
        foreach ($roles as $role)
            foreach (getRightsRoleList($role['idRole']) as $right)
                if(!in_array($right, $list))
                    array_push($list, $right);
        foreach ($list as $row)
            echo($row['rightsTitle']." ; ");
    }

    function addRight($title, $description, $path)
    {
        if(!testValuesRights(null, $title, $path))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO Rights (rightsTitle, rightsDescription, rightsPath) VALUES (:rightsTitle, :rightsDescription, :rightsPath)');

        try{
            $request->execute(array(
                'rightsTitle' => $title,
                'rightsDescription' => $description,
                'rightsPath' => $path
            ));
            return true;
        }
        catch(Exception $e){}
        return false;
    }

    function editRight($id, $title, $description, $path)
    {
        if(!testValuesRights($id, $title, $path))
            return false;

        global $DB_DB;

        $request = $DB_DB->prepare('UPDATE Rights SET rightsTitle = :rightsTitle, 
                                                      rightsDescription = :rightsDescription, 
                                                      rightsPath = :rightsPath
                                    WHERE idRights = :id');

        try{
            $request->execute(array(
                'id' => $id,
                'rightsTitle' => $title,
                'rightsDescription' => $description,
                'rightsPath' => $path
            ));

            return true;
        }
        catch(Exception $e){}

        return false;
    }

    function deleteRight($id)
    {
        global $DB_DB;
        //Suppression de la clef dans according
        $request = $DB_DB->prepare('DELETE FROM according WHERE idRights = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}

        $request = $DB_DB->prepare('DELETE FROM Rights WHERE idRights = :id');

        try{
            $request->execute(array(
                'id' => $id,
            ));
        }
        catch(Exception $e){}
    }

?>