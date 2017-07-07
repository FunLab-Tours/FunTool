<?php

function isValidMachineSubmit() {
    if(isset($_POST['codeMachine']) && isset($_POST['shortLabel']) && isset($_POST['machineUsePrice']) && isset($_POST['serialNumber']))
        if($_POST['codeMachine'] != "" && $_POST['shortLabel'] != "" && $_POST['machineUsePrice'] != "" && $_POST['serialNumber'] != "")
            return true;
    return false;

}

function addMachine() {
    global $DB_DB;

    $request = $DB_DB->prepare('INSERT INTO Machine(codeMachine, shortLabel, longLabel, machineUsePrice, serialNumber, manufacturer, comment, docLink1, docLink2, dateEntry, idFamily, idPicture, idCostUnit, idLab) VALUES(:codeMachine, :shortLabel, :longLabel, :machineUsePrice, :serialNumber, :manufacturer, :comment, :docLink1, :docLink2, NOW(), :idFamily, :idPicture, :idCostUnit, :idLab)');

    try {
        $request->execute(array(
            'codeMachine' => $_POST['codeMachine'],
            'shortLabel' => $_POST['shortLabel'],
            'longLabel' => $_POST['longLabel'],
            'machineUsePrice' => $_POST['machineUsePrice'],
            'serialNumber' => $_POST['serialNumber'],
            'manufacturer' => $_POST['manufacturer'],
            'comment' => $_POST['comment'],
            'docLink1' => $_POST['docLink1'],
            'docLink2' => $_POST['docLink2'],
            'idFamily' => NULL,
            'idPicture' => NULL,
            'idCostUnit' => NULL,
            'idLab' => NULL
        ));

        echo "Ok !";
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }
}

function getMachineList() {
    global $DB_DB;
    return $DB_DB->query('SELECT idMachine, codeMachine FROM Machine');

}

function editMachine() {
    global $DB_DB;

    $request = $DB_DB->prepare('UPDATE Machine SET codeMachine = :codeMachine, shortLabel = :shortLabel, longLabel = :longLabel, machineUsePrice = :machineUsePrice, serialNumber = :serialNumber, manufacturer = :manufacturer, comment = :comment, docLink1 = :docLink1, docLink2 = :docLink2, idFamily = :idFamily, idPicture = :idPicture, idCostUnit = :idCostUnit, idLab = :idLab WHERE idMachine = :idMachine');

    try {
        $request->execute(array(
            'idMachine' => $_POST['machineList'],
            'codeMachine' => $_POST['codeMachine'],
            'shortLabel' => $_POST['shortLabel'],
            'longLabel' => $_POST['longLabel'],
            'machineUsePrice' => $_POST['machineUsePrice'],
            'serialNumber' => $_POST['serialNumber'],
            'manufacturer' => $_POST['manufacturer'],
            'comment' => $_POST['comment'],
            'docLink1' => $_POST['docLink1'],
            'docLink2' => $_POST['docLink2'],
            'idFamily' => NULL,
            'idPicture' => NULL,
            'idCostUnit' => NULL,
            'idLab' => NULL
        ));

        echo "Ok !";
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }
}

function deleteMachine() {
    global $DB_DB;

    $request = $DB_DB->prepare('DELETE FROM Machine WHERE idMachine = :idMachine');

    try {
        $request->execute(array(
            'idMachine' => $_POST['machineList']
        ));

        echo "Ok !";
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }
}

?>
