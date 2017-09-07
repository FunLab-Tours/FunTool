<?php
//Ajouter une formule d'adhésion
    function addMembershipFrame($bonusMembership,$entryDate,$frameName,$framePrice,$frameComment){
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO MembershipFrame(bonusMembership, entryDate, frameName, framePrice, frameComment)                                                 
                                VALUES (:bonusMembership, :entryDate, :frameName, :framePrice, :frameComment)");

        try {
            $stmt->execute(array(
                'bonusMembership' => $bonusMembership,
                'entryDate' => $entryDate,
                'frameName' => $frameName,
                'framePrice' => $framePrice,
                'frameComment' => $frameComment
            ));
        }
        catch(Exception $e) {
            echo $e;
        }    
    }
//Liste de toutes les formules d'adhésion
    function listAllMembershipFrame(){
        global $DB_DB;
        $request = $DB_DB->prepare("SELECT * FROM membershipFrame ORDER BY framePrice ASC");

        try{
            $request->execute();
        }catch(Exception $e){}

        return $request->fetchAll();
    }
//Mettre à jour une formule d'adhésion
    function updateMembershipFrame($idMembershipFrame,$bonusMembership,$entryDate,$frameName,$framePrice, $frameComment){
        global $DB_DB;
        $stmt = $DB_DB->prepare("UPDATE MembershipFrame SET bonusMembership = :bonusMembership, entryDate = :entryDate, 
                                                            frameName = :frameName, framePrice = :framePrice, frameComment = :frameComment
                                                        WHERE idMembershipFrame = :idMembershipFrame");

        try {
            $stmt->execute(array(
                'bonusMembership' => $bonusMembership,
                'entryDate' => $entryDate,
                'frameName' => $frameName,
                'framePrice' => $framePrice,
                'frameComment' => $frameComment,
                'idMembershipFrame' => $idMembershipFrame
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

    }
//Supprimer une formule d'adhésion
    function deleteMembershipFrame($idMembershipFrame){
        global $DB_DB;
        $stmt = $DB_DB->prepare("DELETE FROM MembershipFrame WHERE idMembershipFrame = :idMembershipFrame");

        try {
            $stmt->execute(array(
                'idMembershipFrame' => $idMembershipFrame
            ));
        }
        catch(Exception $e) {
            echo $e;
        }   
    }
//Séléctionner une formule d'adhésion
    function selectMembershipFrame($idMembershipFrame){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT * FROM MembershipFrame WHERE idMembershipFrame=:idMembershipFrame");

        try {
            $stmt->execute(array(
                'idMembershipFrame' => $idMembershipFrame,
            ));
            $result = $stmt->fetch();
            return $result;
        }
        catch(Exception $e) {
            echo $e;
            return "";
        }
    }
//Ajouter un adhérent
    function addMembership($membershipingDate,$endMembershipDate,$paymentMethod,$adminCommentary,$idMembershipFrame,$idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO membershipTransaction(membershipingDate, endMembershipDate, paymentMethod,
                                             adminCommentary, idMembershipFrame, idUser)                                                 
                                VALUES (:membershipingDate, :endMembershipDate, :paymentMethod, 
                                        :adminCommentary, :idMembershipFrame, :idUser)");
                                        

        try {
            $stmt->execute(array(
                'membershipingDate' => $membershipingDate,
                'endMembershipDate' => $endMembershipDate,
                'paymentMethod' => $paymentMethod,
                'adminCommentary' => $adminCommentary,
                'idMembershipFrame' => $idMembershipFrame,
                'idUser' => $idUser
            ));
        }
        catch(Exception $e) {
            echo $e;
        }       
    }

// Renvoie la date de fin d'adhésion si User dans la base sinon renvoi une péremption de 1 jour
    function returnValidDateForMembership($idUser){
        if(isset(selectMembership($idUser)['endMembershipDate'])){
            return selectMembership($idUser)['endMembershipDate'];
        }
        else{
            return -1;
        }
    }
//Calcule la différence de jour entre deux dates
    function compareTwoDates($date1,$date2){
        if($date2){
            $date1ToCompare = date_create($date1);
            $date2ToCompare = date_create($date2);
            $diffDate = date_diff($date1ToCompare,$date2ToCompare);
            $valueDiffDate = $diffDate->format("%R%a");
            return $valueDiffDate;
        }
        else{
            return -1;
        }
    }
//Mettre à jour l'adhérent
    function updateMembership($membershipingDate,$endMembershipDate,$paymentMethod,$adminCommentary,
                              $idMembershipFrame,$idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("UPDATE membershipTransaction SET membershipingDate = :membershipingDate, 
                                 endMembershipDate = :endMembershipDate, paymentMethod = :paymentMethod,
                                 adminCommentary = :adminCommentary, idMembershipFrame = :idMembershipFrame
                                 WHERE idUser = :idUser");
    
        try {
            $stmt->execute(array(
                'membershipingDate' => $membershipingDate,
                'endMembershipDate' => $endMembershipDate,
                'paymentMethod' => $paymentMethod,
                'adminCommentary' => $adminCommentary,
                'idMembershipFrame' => $idMembershipFrame,
                'idUser' => $idUser
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }
//Séléctionne la méthode de paiement d'un utilisateur
    function selectPaymentMethodInMembership($idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT paymentMethod FROM membershipTransaction WHERE idUser=:idUser");

        try {
            $stmt->execute(array(
                'idUser' => $idUser
            ));
            $result = $stmt->fetch()[0];
            return $result;
        }
        catch(Exception $e) {
            echo $e;
            return "";
        }

    }
//Liste de tous les adhérents
    function listAllMembership(){
        global $DB_DB;
        $result = $DB_DB->query("SELECT * FROM membershiptransaction");

        return $result;
    }
//Séléctionne un adhérent
function selectMembership($idUser){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM membershiptransaction WHERE idUser=:idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser,
        ));
        $result = $stmt->fetch();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}
//Supprimer un adhérent
function deleteMembership($idUser){
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM membershiptransaction WHERE idUser = :idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser
        ));
    }
    catch(Exception $e) {
        echo $e;
    }   
}
//Ajoute le bonus de funnies lors de l'adhésion de l'adhérent
function addFunnies($idUser,$bonusMembership){
    global $DB_DB;
    $stmt = $DB_DB->prepare("UPDATE user SET nbFunnies = nbFunnies + :bonusMembership 
                             WHERE idUser = :idUser");
            try {
                $stmt->execute(array(
                    'bonusMembership' => $bonusMembership,
                    'idUser' => $idUser
                ));
            }

            catch(Exception $e) {
                echo $e;
            }  

}
//Recherche un utilisateur
function searchUser($login){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM user WHERE login=:login LIKE '%" .$login. "%'");

    try {
        $stmt->execute(array(
            'login' => $login,
        ));
        $result = $stmt->fetch();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}
    
?>