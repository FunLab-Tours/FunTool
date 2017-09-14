<?php
// AJouter un évenement

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
            throw $e;
        }   
}

// Supprimmer un évenement

function deleteEvent($idEvent) {
    global $DB_DB;
    $stmt = $DB_DB->prepare("DELETE FROM Events WHERE idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent
        ));
    }
    catch(Exception $e) {
        throw $e;
    }
}
// Mettre à jour un évenement

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
        throw $e;
    }
}
// Liste des évenements
function listAllEvent() {
    global $DB_DB;
    $request = $DB_DB->prepare("SELECT * FROM Events");

    try{
        $request->execute();
    }
    catch(Exception $e){
        throw $e;
    }

    return $request->fetchAll();
}
// Séléctionner un évenement
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
        throw $e;
    }
}
// Retourne le nom du label selon l'état de l'évenement choisi
function labelSelectBox($selected){
    global $lang;

    switch ($selected) {
        case 'ok': return $lang["statutOk"];
        case 'maybe': return $lang["statutMaybe"];
        case 'cancel': return $lang["statutCancel"];
        default: return '';
    }
}
//Editer le nom du label selon l'état de l'évenement choisi
function editLabelSelectBox($selected){
    global $lang;
    
    switch ($selected) {
    
        case 'ok' : return "<option value=\"maybe\">".$lang["statutMaybe"]."</option><option value=\"cancel\">".$lang["statutCancel"]."</option>";
        case 'maybe': return "<option value=\"ok\">".$lang["statutOk"]."</option><option value=\"cancel\">".$lang["statutCancel"]."</option>";
        case 'cancel': return "<option value=\"ok\">".$lang["statutOk"]."</option><option value=\"maybe\">".$lang["statutMaybe"]."</option>";
        default: return '';
    }

}
//Compte le nombre de place libre restante(s)
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
            throw $e;
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
//Vérifis si l'utilisateur est déjà enregistré dans l'évenement
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
        throw $e;
    }

    if($request->fetch()['nb_entry'] == 0)
        return false;
        return true;

}
//Détermine l'affichage du bouton d'inscription/désinscription
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

//Montant de funnies de l'utilisateur
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
        throw $e;
    }
}
//Prix de place
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
        throw $e;
    }
}
//Relier l'utilisateur à l'évènement
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
        throw $e;
    }
}
// Mettre à jour les funnies de l'utilisateur
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
        throw $e;
    }
}
//Désinscription de l'utilisateur à l'évènement
function userUnregistrationToEvent($idUser,$idEvent){
    global $DB_DB;

    $stmt = $DB_DB->prepare("DELETE FROM register WHERE idUser = :idUser AND idEvent = :idEvent");

    try {
        $stmt->execute(array(
            'idUser' => $idUser,
            'idEvent' => $idEvent
        ));
        $userFunniesLeft = currentUserFunnies($idUser)+ticketPrice($idEvent);
        updateUserFunnies($idUser,$userFunniesLeft);
    }
    catch(Exception $e) {
        throw $e;
    }

}
//Séléctionne tous les utilisateur d'un évènement
function selectAllUsersInEvent($idEvent){
    global $DB_DB;
    $stmt = $DB_DB->prepare("SELECT idUser FROM register WHERE idEvent=:idEvent");

    try {
        $stmt->execute(array(
            'idEvent' => $idEvent,
        ));
        $result = $stmt->fetchAll();
        return $result;
    }
    catch(Exception $e) {
        throw $e;
    }
}
//Nom d'un utilisateur dans un évènement
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
        throw $e;
    }
}



?>