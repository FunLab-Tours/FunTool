<?php

function addLab ($labName, $labDescription)
{
    global $DB_DB;
    $stmt = $DB_DB->prepare("INSERT INTO Lab (labName, labDescription) VALUES (?, ?)");
    $stmt->bindParam(1, $labName);
    $stmt->bindParam(2, $labDescription);
    $stmt->execute();
}

function deleteLab($idLab)
{
    global $DB_DB;
    $sql = "DELETE FROM Lab WHERE idLab=$idLab";
    $result = $DB_DB->query($sql);
    return $result;
}

function updateLab($idLab, $labName, $labDescription)
{
    global $DB_DB;
    $sql = "UPDATE Lab SET labName = '$labName', labDescription = '$labDescription' WHERE idLab=$idLab";
    $result = $DB_DB->query($sql);
    return $result;
}

function listAllLab()
{
    global $DB_DB;
    $sql = "SELECT * FROM Lab ORDER BY labName";
    $result = $DB_DB->query($sql);
    return $result ;
}

?>