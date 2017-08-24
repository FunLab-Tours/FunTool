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

function isValidMembership($idUser){
    global $DB_DB;
    global $lang;
    $request = $DB_DB->prepare("SELECT COUNT(idUser) as ticketsSold FROM register WHERE idEvent = :idEvent");

        try {
            $request->execute(array(
            'idEvent' => $idEvent
            ));
        }
        catch(Exception $e) {
                echo $e;
        }
}
?>