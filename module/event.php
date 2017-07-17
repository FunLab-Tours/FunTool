<?php

function addEvent ($shortSumEvent,$longSumEvent,$startdateEvent,$endDatEvent,$statutEvent,$nbPlaces,$pricePlace){

        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO Event (shortSumEvent, longSumEvent, startdateEvent, endDatEvent, statutEvent, nbPlaces, pricePlace) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt = $DB_DB->prepare($sql);

        try {
            $stmt->execute(array($shortSumEvent,$longSumEvent,$startdateEvent,$endDatEvent,$statutEvent,$nbPlaces,$pricePlace));
            echo "Event Updated";
        }
        
        catch(Exception $e){
                            echo $e;
                            exit;
        }   
}
?>