<?php
function listAllProject(){
    global $DB_DB;
    $result = $DB_DB->query("SELECT * FROM project");

    return $result;
}

function addProject ($projectTitle,$projectWiki,$dateProject){
    
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO project(title, wiki, dateProject) VALUES (:title, :wiki, :dateProject)");


        try {
            $stmt->execute(array(
            'title' => $projectTitle,
            'wiki' => $projectWiki,
            'dateProject' => $dateProject
            ));
        }
        
        catch(Exception $e){
                            echo $e;
                            exit;
        }   
}

function selectProject($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM project WHERE idProject=:idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject,
        ));
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

function updateProject($idProject,$projectTitle,$projectWiki,$dateProject) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("UPDATE project SET title = :title, wiki = :wiki, dateProject = :dateProject WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject,
            'title' => $projectTitle,
            'wiki' => $projectWiki,
            'dateProject' => $dateProject
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function deleteProject($idProject) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM project WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function deletePictureLinkToProject($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM picture WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function selectAllProjectCategory(){
        global $DB_DB;
        $result = $DB_DB->query("SELECT title FROM projectcategory");

        return $result;

}

function selectAllMachine(){
        global $DB_DB;
        $result = $DB_DB->query("SELECT shortLabel FROM Machine");

        return $result;

}

function addPictureProject($picture,$idProject){
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO picture(picture, idProject) VALUES (:picture, :idProject)");


        try {
            $stmt->execute(array(
            'picture' => $picture,
            'idProject' => $idProject
            ));
        }
        
        catch(Exception $e){
                            echo $e;
                            exit;
        }       
}

function lastInsertProjectId(){
        global $DB_DB;
        $stmt = $DB_DB->query("SELECT max(idProject) FROM Project");
        $result = $stmt->fetch()['max(idProject)'];
        return $result;
}

function selectProjectPicture($idProject){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT picture FROM picture WHERE idProject = :idProject");
    try {
        $stmt->execute(array(
            'idProject' => $idProject,
        ));
        $result = $stmt->fetch()['picture'];
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

function showRegisterButton($idProject,$alreadyRegistered){
    global $lang;
    if ($alreadyRegistered){
        return "<a href=\"index.php?page=project&idUnregister=$idProject\" class=\"button\">".$lang["unregister"]."</a>";
    }
    else {
        return "<a href=\"index.php?page=project&idRegister=$idProject\" class=\"button\">".$lang["register"]."</a>";
       
    }
}

function alreadyRegistered($idProject,$idUser){
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT COUNT(idUser) as nb_entry FROM participate WHERE idProject = :idProject AND idUser= :idUser");

    try {
        $request->execute(array(
        'idProject' => $idProject,
        'idUser' => $idUser
        ));
        }
    catch(Exception $e) {
         echo $e;
    }
}

?>