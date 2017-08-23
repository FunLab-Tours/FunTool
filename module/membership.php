<?php
function addMembershipFrame($bonusMembership,$entryDate,$frameName,$framePrice){
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO MembershipFrame(bonusMembership, entryDate, frameName, framePrice)                                                 
                             VALUES (:bonusMembership, :entryDate, :frameName, :framePrice)");

    try {
        $stmt->execute(array(
            'bonusMembership' => $bonusMembership,
            'entryDate' => $entryDate,
            'frameName' => $frameName,
            'framePrice' => $framePrice
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

function updateMembershipFrame($bonusMembership,$entryDate,$frameName,$framePrice){
    global $DB_DB;
    $stmt = $DB_DB->prepare("UPDATE MembershipFrame SET bonusMembership = :bonusMembership, entryDate = :entryDate, 
                                                        frameName = :frameName, framePrice = :framePrice
                                                    WHERE idMembershipFrame = :idMembershipFrame");

    try {
        $stmt->execute(array(
            'bonusMembership' => $bonusMembership,
            'entryDate' => $entryDate,
            'frameName' => $frameName,
            'framePrice' => $framePrice,
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
?>