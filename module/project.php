<?php
function listAllProject(){
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM Project");

    try{
        $request->execute();
    }catch(Exception $e){}

    return $request->fetchAll();
}

function addProject ($projectTitle,$projectWiki,$dateProject){
    
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO Project(title, wiki, dateProject) VALUES (:title, :wiki, :dateProject)");


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
    $stmt = $DB_DB->prepare("SELECT * FROM Project WHERE idProject=:idProject");

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
    $stmt = $DB_DB->prepare("UPDATE Project SET title = :title, wiki = :wiki, dateProject = :dateProject WHERE idProject = :idProject");

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
    $stmt = $DB_DB->prepare("DELETE FROM Project WHERE idProject = :idProject");

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
    $request = $DB_DB->prepare("SELECT * FROM projectcategory");

    try{
        $request->execute();
    }catch(Exception $e){}

    return $request->fetchAll();
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
        $request = $DB_DB->prepare("SELECT max(idProject) FROM Project");

        try{
            $request->execute();
        }catch(Exception $e){}

        $result = $request->fetch()['max(idProject)'];
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

function showRegisterButtonProject($idProject,$alreadyRegistered){
    global $lang;
    if ($alreadyRegistered){
        return "<a href=\"index.php?page=project&idUnregister=$idProject\" class=\"button\">".$lang["unregister"]."</a>";
    }
    else {
        return "<a href=\"index.php?page=project&idRegister=$idProject\" class=\"button\">".$lang["register"]."</a>";
       
    }
}

function alreadyRegisteredProject($idProject,$idUser){
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

function addProjectCategory($title,$longCategoryLabel){
    $shortCategoryLabel = "";
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO projectCategory(title,shortCategoryLabel,longCategoryLabel) 
                             VALUES (:title, :shortCategoryLabel, :longCategoryLabel)");
    
    try {
        $stmt->execute(array(
        'title' => $title,
        'shortCategoryLabel' => $shortCategoryLabel,
        'longCategoryLabel' => $longCategoryLabel
        ));
    }
    
    catch(Exception $e){
                        echo $e;
                        exit;
    } 
}

function listAllProjectCategory(){
    global $DB_DB;
    $result = $DB_DB->query("SELECT * FROM projectCategory");

    return $result;    
}

function linkToProjectCategory($idProCat,$idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO isincludein(idProCat,idProject) 
                             VALUES (:idProCat, :idProject)");
    
    try {
        $stmt->execute(array(
        'idProCat' => $idProCat,
        'idProject' => $idProject
        ));
    }
    
    catch(Exception $e){
                        echo $e;
                        exit;
    } 
}


function deleteProjectIncludeIn($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM isincludein WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function selectProjectInIsIncludeIn($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM isincludein WHERE idProject = :idProject");
try {
    $stmt->execute(array(
        'idProject' => $idProject
    ));
    $result = $stmt->fetch();
    return $result;
}
catch(Exception $e) {
    echo $e->errorMessage();
    return "";
}  
}

function selectSpecificProjectCategory($idProCat){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM projectCategory WHERE idProCat = :idProCat");
try {
    $stmt->execute(array(
        'idProCat' => $idProCat
    ));
    $result = $stmt->fetch();
    return $result;
}
catch(Exception $e) {
    echo $e->errorMessage();
    return "";
}  
}

function addParticipantToProject($idUser,$idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO participate(idUser, idProject) 
                             VALUES (:idUser, :idProject)");


    try {
        $stmt->execute(array(
        'idUser' => $idUser,
        'idProject' => $idProject
        ));
    }
    
    catch(Exception $e){
                        echo $e;
                        exit;
    }   
}

function selectParticipantsToProject($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM participate WHERE idProject = :idProject");
try {
    $stmt->execute(array(
        'idProject' => $idProject
    ));
    $result = $stmt->fetch();
    return $result;
}
catch(Exception $e) {
    echo $e->errorMessage();
    return "";
}  
}

function selectUser($idUser){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM user WHERE idUser = :idUser");
try {
    $stmt->execute(array(
        'idUser' => $idUser
    ));
    $result = $stmt->fetch();
    return $result;
}
catch(Exception $e) {
    echo $e->errorMessage();
    return "";
}    
}


//Gestion des erreurs

// function testerror($idUser){
//     global $DB_DB;
//     $stmt = $DB_DB->prepare("SELECT * FROM user WHERE idUser = :idUser");
// try {
//     $stmt->execute(array(
//         'idUser' => $idUser
//     ));
//     $result = $stmt->fetch() or throw_ex(mysql_error());
//     return $result;
// }
// catch(Exception $e) {
//     // echo $e;
//     echo $e->errorMessage();
//     return "";
// }    
// }


//   function throw_ex($er){  
//     throw new customException($er);  
//   }

//   class customException extends Exception {
//     public function errorMessage() {
//       //error message
//       $errorMsg = 'Error in '.$this->getFile()
//       .': <b>'.$this->getMessage().'</b> La requête n\'a pas pû aboutir';
//       return $errorMsg;
//     }
//   }

function deleteProjectParticipate($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM participate WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function deleteProjectCategoryIncludeIn($idProCat){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM isincludein WHERE idProCat = :idProCat");

    try {
        $stmt->execute(array(
            'idProCat' => $idProCat
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function deleteProjectCategory($idProCat){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM projectCategory WHERE idProCat = :idProCat");

    try {
        $stmt->execute(array(
            'idProCat' => $idProCat
        ));
    
    }
    catch(Exception $e) {
        echo $e;
    }
}

function updateProjectCategory($idProCat,$title,$longCategoryLabel){
    global $DB_DB;
    $stmt = $DB_DB->prepare("UPDATE projectCategory SET title = :title, longCategoryLabel = :longCategoryLabel 
                             WHERE idProCat = :idProCat");

    try {
        $stmt->execute(array(
            'title' => $title,
            'longCategoryLabel' => $longCategoryLabel,
            'idProCat' => $idProCat
        ));
    }
    catch(Exception $e) {
        echo $e;
    }   
}
?>