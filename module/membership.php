<?php
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

    function listAllMembershipFrame(){
        global $DB_DB;
        $result = $DB_DB->query("SELECT * FROM membershipFrame");

        return $result;
    }

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

    function selectMembershipFrame($idMembershipFrame){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT * FROM MembershipFrame WHERE idMembershipFrame=:idMembershipFrame");

        try {
            $stmt->execute(array(
                'idMembershipFrame' => $idMembershipFrame,
            ));
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(Exception $e) {
            echo $e;
            return "";
        }
    }

    function addMembership($membershipingDate,$endMembershipDate,$paymentMethod,$adminCommentary,$idMembershipFrame,$idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO membershiptransaction(membershipingDate, endMembershipDate, paymentMethod,
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

    function selectEndMembershipDate($idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT endMembershipDate FROM MembershipTransaction WHERE idUser=:idUser");

        try {
            $stmt->execute(array(
                'idUser' => $idUser
            ));
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(Exception $e) {
            echo $e;
            return "";
        }

    }
// Renvoie la date de fin d'adhésion si User dans la base sinon renvoi une péremption de 1 jour
    function returnValidDateForMembership($idUser){
        if(isset(selectEndMembershipDate($idUser)[0]['endMembershipDate'])){
            return selectEndMembershipDate($idUser)[0]['endMembershipDate'];
        }
        else{
            return -1;
        }
    }

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

    function updateMembership($membershipingDate,$endMembershipDate,$paymentMethod,$adminCommentary,
                              $idMembershipFrame,$idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("UPDATE membershiptransaction SET membershipingDate = :membershipingDate, 
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

    function selectPaymentMethodInMembership($idUser){
        global $DB_DB;
        $stmt = $DB_DB->prepare("SELECT paymentMethod FROM MembershipTransaction WHERE idUser=:idUser");

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

    function listAllMembership(){
        global $DB_DB;
        $result = $DB_DB->query("SELECT * FROM membershiptransaction");

        return $result;
    }
?>