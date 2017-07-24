<?php

function addEvent ($shortSumEvent,$longSumEvent,$startdateEvent,$endDatEvent,$statutEvent,$nbPlaces,$pricePlace){
    
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO events(shortSumEvent, longSumEvent, startdateEvent, endDatEvent, statutEvent, nbPlaces, pricePlace) VALUES (:shortSumEvent, :longSumEvent, :startdateEvent, :endDatEvent, :statutEvent, :nbPlaces, :pricePlace)");


        try {
            $stmt->execute(array(
            'shortSumEvent' => $shortSumEvent,
            'longSumEvent' => $longSumEvent,
            'startdateEvent' => $startdateEvent,
            'endDatEvent' => $endDatEvent,
            'statutEvent' => $statutEvent,
            'nbPlaces' => $nbPlaces,
            'pricePlace' => $pricePlace
            ));
            echo $statutEvent;
        }
        
        catch(Exception $e){
                            echo $e;
                            exit;
        }   
}

function deleteEvent($idEvent) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM events WHERE idEvent = :idEvent");

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
    $stmt = $DB_DB->prepare("UPDATE events SET shortSumEvent = :shortSumEvent, longSumEvent = :longSumEvent, startdateEvent = :startdateEvent, endDatEvent = :endDatEvent, statutEvent = :statutEvent, nbPlaces = :nbPlaces, pricePlace = :pricePlace WHERE idEvent = :idEvent");

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
    $result = $DB_DB->query("SELECT * FROM events");

    return $result;
}

function selectEvent($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT * FROM events WHERE idEvent=:idEvent");

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
        return $ticketsLeft;
    } 
}

function showSubButton($ticketsLeft,$idEvent){
    global $lang;

    if($ticketsLeft!==0){
        return "<a href=\"index.php?page=event&idSubscribe=$idEvent\" class=\"button\">".$lang["subscription"]."</a>";
        //return "<form action=\"\" method=\"POST\"> <input type=\"submit\" value=".$lang["subscription"]."></form>";
    
    }
}

?>