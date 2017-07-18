<?php

function addEvent ($shortSumEvent,$longSumEvent,$startdateEvent,$endDatEvent,$statutEvent,$nbPlaces,$pricePlace){
    
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO eventz(shortSumEvent, longSumEvent, startdateEvent, endDatEvent, statutEvent, nbPlaces, pricePlace) VALUES (:shortSumEvent, :longSumEvent, :startdateEvent, :endDatEvent, :statutEvent, :nbPlaces, :pricePlace)");


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
            echo $shortSumEvent;
            echo $longSumEvent;
            echo $startdateEvent;
            echo $endDatEvent;
            echo $statutEvent;
            echo $nbPlaces;
            echo $pricePlace;
        }
        
        catch(Exception $e){
                            echo $e;
                            exit;
        }   
}

function deleteEvent($idEvent) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM 'event' WHERE idEvent = :idEvent");

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
    $stmt = $DB_DB->prepare("UPDATE Event SET shortSumEvent = :shortSumEvent, longSumEvent = :longSumEvent, startdateEvent = :startdateEvent, endDatEvent = :endDatEvent, statutEvent = :statutEvent, nbPlaces = :nbPlaces, pricePlace = :pricePlace WHERE idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'shortSumEvent' => $shortSumEvent,
            'shortSumEvent' => $shortSumEvent,
            'startdateEvent' => $startdateEvent,
            'endDatEvent' => $endDatEvent,
            'statutEvent' => $statutEvent,
            'nbPlaces' => $nbPlaces,
            'pricePlace' => $pricePlace,

        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function listAllEvent() {
    global $DB_DB;
    $result = $DB_DB->query("SELECT * FROM eventz");

    return $result;
}
?>