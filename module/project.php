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
?>