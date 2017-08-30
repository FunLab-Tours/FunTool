<?php

function addEvent($shortSumEvent, $longSumEvent, $startDateEvent, $endDateEvent, $statutEvent, $nbPlaces, $pricePlace) {
        global $DB_DB;
        $stmt = $DB_DB->prepare('INSERT INTO Events(shortSumEvent, longSumEvent, startdateEvent, endDatEvent, 
                                                    statutEvent, nbPlaces, pricePlace) 
                                    VALUES (:shortSumEvent, :longSumEvent, :startDateEvent, :endDateEvent, :statutEvent,
                                            :nbPlaces, :pricePlace)');

        try {
            $stmt->execute(array(
                'shortSumEvent' => $shortSumEvent,
                'longSumEvent' => $longSumEvent,
                'startDateEvent' => $startDateEvent,
                'endDateEvent' => $endDateEvent,
                'statutEvent' => $statutEvent,
                'nbPlaces' => $nbPlaces,
                'pricePlace' => $pricePlace
            ));
        }
        
        catch(Exception $e){
            echo $e;
            exit;
        }   
}

function deleteEvent($idEvent) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM Events WHERE idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function updateEvent($idEvent,$shortSumEvent,$longSumEvent,$startdateEvent,$endDatEvent,$statutEvent,$nbPlaces,$pricePlace) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("UPDATE Events SET shortSumEvent = :shortSumEvent, longSumEvent = :longSumEvent, startdateEvent = :startdateEvent, endDatEvent = :endDatEvent, statutEvent = :statutEvent, nbPlaces = :nbPlaces, pricePlace = :pricePlace WHERE idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent,
            'shortSumEvent' => $shortSumEvent,
            'longSumEvent' => $longSumEvent,
            'startdateEvent' => $startdateEvent,
            'endDatEvent' => $endDatEvent,
            'statutEvent' => $statutEvent,
            'nbPlaces' => $nbPlaces,
            'pricePlace' => $pricePlace

        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function listAllEvent() {
    global $DB_DB;
    $result = $DB_DB->query("SELECT * FROM Events");

    return $result;
}

function selectEvent($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM Events WHERE idEvent=:idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent,
        ));
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

function labelSelectBox($selected){
    global $lang;

    switch ($selected) {
        case 'ok': return $lang["statutOk"];
        case 'maybe': return $lang["statutMaybe"];
        case 'cancel': return $lang["statutCancel"];
        default: return '';
    }
}

function editLabelSelectBox($selected){
    global $lang;
    
    switch ($selected) {
    
        case 'ok' : return "<option value=\"maybe\">".$lang["statutMaybe"]."</option><option value=\"cancel\">".$lang["statutCancel"]."</option>";
        case 'maybe': return "<option value=\"ok\">".$lang["statutOk"]."</option><option value=\"cancel\">".$lang["statutCancel"]."</option>";
        case 'cancel': return "<option value=\"ok\">".$lang["statutOk"]."</option><option value=\"maybe\">".$lang["statutMaybe"]."</option>";
        default: return '';
    }

}

function ticketsLeft($allTickets,$idEvent){
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

    $ticketsSold = $request->fetch()['ticketsSold'];
    $ticketsLeft = $allTickets-$ticketsSold;
    
    if($ticketsLeft==0){
        return $lang["full"];
    }
    else{
        return $ticketsLeft."/".$allTickets;
    } 
}

function alreadyRegistered($idEvent,$idUser){
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT COUNT(idUser) as nb_entry FROM register WHERE idEvent = :idEvent AND idUser= :idUser");

    try {
        $request->execute(array(
        'idEvent' => $idEvent,
        'idUser' => $idUser
        ));
        }
    catch(Exception $e) {
         echo $e;
    }

    if($request->fetch()['nb_entry'] == 0)
        return false;
        return true;

}

function showRegisterButton($ticketsLeft,$idEvent,$alreadyRegistered){
    global $lang;
    if ($alreadyRegistered){
        return "<a href=\"index.php?page=event&idUnregister=$idEvent\" class=\"button\">".$lang["unregister"]."</a>";
    }
    else if($ticketsLeft>0){
        return "<a href=\"index.php?page=event&idRegister=$idEvent\" class=\"button\">".$lang["register"]."</a>";
    }
    else return $lang["full"];
}


function currentUserFunnies($idUser) {
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

function ticketPrice($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT pricePlace FROM Events WHERE idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent
        ));

        $result = $stmt->fetch();
        return $result['pricePlace'];
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

function userRegistrationToEvent($idUser,$idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO register(idUser, idEvent) VALUES(:idUser, :idEvent)");

    try {
        $stmt->execute(array(
            'idUser' => $idUser,
            'idEvent' => $idEvent
        ));

        $userFunniesLeft = currentUserFunnies($idUser) - ticketPrice($idEvent);
        updateUserFunnies($idUser, $userFunniesLeft);
    }
    catch(Exception $e){
        echo $e;
        exit;
    }
}

function updateUserFunnies($idUser,$userFunniesLeft){
    global $DB_DB;

    $stmt = $DB_DB->prepare("UPDATE User SET nbFunnies = :nbFunnies WHERE idUser = :idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser,
            'nbFunnies' => $userFunniesLeft

        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function userUnregistrationToEvent($idUser,$idEvent){
    global $DB_DB;

    $stmt = $DB_DB->prepare("DELETE FROM register WHERE idUser = :idUser");

    try {
        $stmt->execute(array(
            'idUser' => $idUser
        ));
        $userFunniesLeft = currentUserFunnies($idUser)+ticketPrice($idEvent);
        updateUserFunnies($idUser,$userFunniesLeft);
    }
    catch(Exception $e) {
        echo $e;
    }

}

function selectAllUsersInEvent($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT idUser FROM register WHERE idEvent=:idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent,
        ));
        $result = $stmt->fetch();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}

function nameOfUsersInEvent($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT firstName, telephone FROM User u INNER JOIN register r ON u.idUser = r.idUser WHERE idEvent=:idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent,
        ));

        $result = $stmt->fetchAll();
        return $result;
    }
    catch(Exception $e) {
        echo $e;
        return "";
    }
}



?>