<?php

function addLab ($labName, $labDescription)
    {
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO Lab (labName, labDescription) VALUES (?, ?)");
        $stmt->bindParam(1, $labName);
        $stmt->bindParam(2, $labDescription);
            try
                {
                    $stmt->execute();
                    echo "Lab added";
                }

            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }


function deleteLab($idLab)
    {
        global $DB_DB;
        $stmt = $DB_DB->prepare("DELETE FROM Lab WHERE idLab=?");
        $stmt->bindParam(1, $idLab);
            try
                {
                    $stmt->execute();
                    echo "Lab deleted";
                }
        
            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }

function updateLab($idLab, $labName, $labDescription)
    {
        global $DB_DB;
        $sql = "UPDATE Lab SET labName =?, labDescription =? WHERE idLab=?";
        $stmt->bindParam(1, $labName);
        $stmt->bindParam(2, $labDescription);
        $stmt->bindParam(3, $idLab);
            try
                {
                    $stmt->execute();
                    echo "Lab Updated";
                }
        
            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }

function listAllLab()
    {
        global $DB_DB;
        $sql = "SELECT * FROM Lab";
        $result = $DB_DB->query($sql);
        return $result;
    }
?>