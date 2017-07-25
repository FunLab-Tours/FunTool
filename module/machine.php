<?php
    // TODO : use parameters.

    function isValidMachineSubmit() {
        if(isset($_POST['codeMachine']) && isset($_POST['shortLabel']) && isset($_POST['machineUsePrice']) && isset($_POST['serialNumber']))
            if($_POST['codeMachine'] != "" && $_POST['shortLabel'] != "" && $_POST['machineUsePrice'] != "" && $_POST['serialNumber'] != "")
                return true;
        return false;

    }

    function addMachine($codeMachine, $shortLabel, $longLabel, $machineUsePrice, $serialNumber, $manufacturer, $comment, $docLink1, $docLink2, $idFamily, $idPicture, $idCostUnit, $idLab) {
        global $DB_DB;

        $request = $DB_DB->prepare('INSERT INTO Machine(codeMachine, shortLabel, longLabel, machineUsePrice, serialNumber, manufacturer, comment, docLink1, docLink2, dateEntry, idFamily, idPicture, idCostUnit, idLab) VALUES(:codeMachine, :shortLabel, :longLabel, :machineUsePrice, :serialNumber, :manufacturer, :comment, :docLink1, :docLink2, NOW(), :idFamily, :idPicture, :idCostUnit, :idLab)');

        try {
            $request->execute(array(
                'codeMachine' => $codeMachine,
                'shortLabel' => $shortLabel,
                'longLabel' => $longLabel,
                'machineUsePrice' => $machineUsePrice,
                'serialNumber' => $serialNumber,
                'manufacturer' => $manufacturer,
                'comment' => $comment,
                'docLink1' => $docLink1,
                'docLink2' => $docLink2,
                'idFamily' => NULL, //$idFamily,
                'idPicture' => NULL, //$idPicture,
                'idCostUnit' => NULL, //$idCostUnit,
                'idLab' => NULL //$idLab
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit;
        }
    }

    function getMachineList() {
        global $DB_DB;
        return $DB_DB->query('SELECT * FROM Machine');

    }

    function editMachine($idMachine, $codeMachine, $shortLabel, $longLabel, $machineUsePrice, $serialNumber, $manufacturer, $comment, $docLink1, $docLink2, $idFamily, $idPicture, $idCostUnit, $idLab) {
        global $DB_DB;

        $request = $DB_DB->prepare('UPDATE Machine SET  codeMachine = :codeMachine,
                                                        shortLabel = :shortLabel,
                                                        longLabel = :longLabel,
                                                        machineUsePrice = :machineUsePrice,
                                                        serialNumber = :serialNumber,
                                                        manufacturer = :manufacturer,
                                                        comment = :comment,
                                                        docLink1 = :docLink1,
                                                        docLink2 = :docLink2,
                                                        idFamily = :idFamily,
                                                        idPicture = :idPicture,
                                                        idCostUnit = :idCostUnit,
                                                        idLab = :idLab
                                    WHERE idMachine = :idMachine');

        try {
            $request->execute(array(
                'idMachine' => $idMachine,
                'codeMachine' => $codeMachine,
                'shortLabel' => $shortLabel,
                'longLabel' => $longLabel,
                'machineUsePrice' => $machineUsePrice,
                'serialNumber' => $serialNumber,
                'manufacturer' => $manufacturer,
                'comment' => $comment,
                'docLink1' => $docLink1,
                'docLink2' => $docLink2,
                'idFamily' => NULL, //$idFamily,
                'idPicture' => NULL, //$idPicture,
                'idCostUnit' => NULL, //$idCostUnit,
                'idLab' => NULL //$idLab
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function deleteMachine($idDelete) {
        global $DB_DB;
        $request = $DB_DB->prepare('DELETE FROM Machine WHERE idMachine = :idMachine');

        try {
            $request->execute(array(
                'idMachine' => $idDelete
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }

?>
