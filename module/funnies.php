<?php
//Nombre de funnies de l'utilisateur
function currentUserFunnies($idUser){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT nbFunnies FROM User WHERE idUser=:idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser
        ));
        $result = $stmt->fetch();
        return $result['nbFunnies'];
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

//Mettre à jour les funnies de l'utilisateur
function updateUserFunnies($idUser,$newFunniesBalance){
    global $DB_DB;

    $stmt = $DB_DB->prepare("UPDATE User SET nbFunnies = :nbFunnies WHERE idUser = :idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser,
            'nbFunnies' => $newFunniesBalance
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}
?>