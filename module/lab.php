<?php
// Ajouter un Lab

    function addLab($labName, $labDescription) {
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO Lab(labName, labDescription) VALUES (:labName, :labDescription)");

        try {
            $stmt->execute(array(
                'labName' => $labName,
                'labDescription' => $labDescription
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }
// Supprimer un Lab

    function deleteLab($idLab) {
        global $DB_DB;
        $stmt = $DB_DB->prepare("DELETE FROM Lab WHERE idLab = :idLab");

        try {
            $stmt->execute(array(
                'idLab' => $idLab
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }
// Mettre à jour les données d'un lab

    function updateLab($idLab, $labName, $labDescription) {
        global $DB_DB;
        $stmt = $DB_DB->prepare("UPDATE Lab SET labName = :labName, labDescription = :labDescription WHERE idLab = :idLab");

        try {
            $stmt->execute(array(
                'labName' => $labName,
                'labDescription' => $labDescription,
                'idLab' => $idLab
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }

// Liste de tous les Labs
    function listAllLab() {
        global $DB_DB;

        $request = $DB_DB->prepare("SELECT * FROM Lab");

        try{
            $request->execute(array());
        }catch(Exception $e){}

        return $request->fetchAll();
    }

// Vérification que le Lab n'existe pas

    function isValideLab($labName) {
        if($labName == "") {
            return false;
        }
        else {
            global $DB_DB;
            $request = $DB_DB->prepare("SELECT COUNT(labName) as nb_entry FROM lab WHERE labName = :labName");

            try {
                $request->execute(array(
                    'labName' => $labName,
                    ));
            }
            catch(Exception $e) {
                echo $e;
            }

            if($request->fetch()['nb_entry'] == 0)
                return true;
            return false;
        }

    }

// Selectionne le nom du lab

    function getLabName($idLab)
    {
        global $DB_DB;
        $request = $DB_DB->prepare('SELECT labName FROM lab WHERE idLab = :idLab');

        try {
            $request->execute(array(
                'idLab' => $idLab
            ));
        }
        catch(Exception $e) {
            echo $e;
            exit();
        }
        return $request->fetch()[0];
    }

?>
