<?php
//Liste de tous les projets
function listAllProject(){
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM Project");

    try{
        $request->execute();
    }
    catch(Exception $e){
        throw $e;
    }

    return $request->fetchAll();
}
//Ajoute un projet
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
            throw $e;
        }   
}
//Séléctionne un projet
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
        throw $e;
    
    }
}
//Mettre à jour un projet
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
        throw $e;
    }
}
//Supprimer un projet
function deleteProject($idProject) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM Project WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Supprimer l'image d'un projet
function deletePictureLinkToProject($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM picture WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Liste de toutes les catégories de projets
function selectAllProjectCategory(){
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM projectcategory");

    try{
        $request->execute();
    }
    catch(Exception $e){
        throw $e;
    }

    return $request->fetchAll();
}
//Ajoute l'image d'un projet
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
            throw $e;
            
        }       
}
//Dernier projet inséré
function lastInsertProjectId(){
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT max(idProject) FROM Project");

        try{
            $request->execute();
        }
        catch(Exception $e){
            throw $e;
        }

        $result = $request->fetch()['max(idProject)'];
        return $result;
}
//Séléctionne l'image d'un projet
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
        throw $e;
    }
}
//Mettre le bouton d'inscription d'un projet
function showRegisterButtonProject($idProject,$alreadyRegistered){
    global $lang;
    if ($alreadyRegistered){
        return "<a href=\"index.php?page=project&idUnregister=$idProject\" class=\"button\">".$lang["unregister"]."</a>";
    }
    else {
        return "<a href=\"index.php?page=project&idRegister=$idProject\" class=\"button\">".$lang["register"]."</a>";
       
    }
}
//Vérifis que l'utilisateur est déjà inscrit au projet
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
        throw $e;
    }
}
//Ajouter une catégorie de projet
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
        throw $e;
    } 
}
//Liste des catégories de Projet
function listAllProjectCategory(){
    global $DB_DB;
    $result = $DB_DB->query("SELECT * FROM projectCategory");

    return $result;    
}
//Relie un projet à une catégorie de projet
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
        throw $e;
    } 
}

//Supprime un projet d'une catégorie de projet
function deleteProjectIncludeIn($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM isincludein WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Séléctionne un projet dans une catégorie de projet
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
    throw $e;
}  
}
//Séléctionne une catégorie de projet
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
    throw $e;
}  
}
//Ajoute un participant au projet
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
        throw $e;
    }   
}
//Séléctionne un participant au projet
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
    throw $e;
}  
}
//Séléctionne un utilisateur
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
    throw $e;
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

//Supprime un projet de toutes les participations au projet
function deleteProjectParticipate($idProject){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM participate WHERE idProject = :idProject");

    try {
        $stmt->execute(array(
            'idProject' => $idProject
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Supprime une catégorie de projet d'un projet
function deleteProjectCategoryIncludeIn($idProCat){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM isincludein WHERE idProCat = :idProCat");

    try {
        $stmt->execute(array(
            'idProCat' => $idProCat
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Supprime une catégorie de projet
function deleteProjectCategory($idProCat){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM projectCategory WHERE idProCat = :idProCat");

    try {
        $stmt->execute(array(
            'idProCat' => $idProCat
        ));
    
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Mettre à jour une catégorie de projet
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
        throw $e;
    }   
}
?>