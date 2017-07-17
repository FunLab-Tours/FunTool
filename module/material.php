<?php

function isValidMaterialSubmit() {
    if(isset($_POST['label']) && isset($_POST['code']) && isset($_POST['price']))
        if($_POST['label'] != "" && $_POST['code'] != "" && $_POST['price'] != "")
            return true;

    return false;

}

function addMaterial() {
    global $DB_DB;
    $request = $DB_DB->prepare('INSERT INTO Materials(labelMat,
                                                      codeMat,
                                                      priceMat,
                                                      datePrice,
                                                      docLink,
                                                      comment,
                                                      dateEntry,
                                                      idPicture)
                                VALUES( :labelMat,
                                        :codeMat,
                                        :priceMat,
                                        :datePrice,
                                        :docLink,
                                        :comment,
                                        NOW(),
                                        :idPicture)');

    try {
        $request->execute(array(
            'labelMat' => $_POST['label'],
            'codeMat' => $_POST['code'],
            'priceMat' => $_POST['price'],
            'datePrice' => NULL,
            'docLink' => $_POST['docLink'],
            'comment' => $_POST['comment'],
            'idPicture' => NULL
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function getMaterialList() {
    global $DB_DB;
    return $DB_DB->query('SELECT idMat, labelMat FROM Materials');
}

function editMaterial() {
    global $DB_DB;
    $request = $DB_DB->prepare('UPDATE Materials SET  labelMat = :labelMat,
                                                      codeMat = :codeMat,
                                                      priceMat = :priceMat,
                                                      docLink = :docLink,
                                                      comment = :comment
                                WHERE idMat = :idMat');

    try {
        $request->execute(array(
            'idMat' => $_POST['materialList'],
            'labelMat' => $_POST['label'],
            'codeMat' => $_POST['code'],
            'priceMat' => $_POST['price'],
            'docLink' => $_POST['docLink'],
            'comment' => $_POST['comment']
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

function deleteMaterial() {
    global $DB_DB;
    $request = $DB_DB->prepare('DELETE FROM Materials WHERE idMat = :idMat');

    try {
        $request->execute(array(
            'idMat' => $_POST['materialList']
        ));
    }
    catch(Exception $e) {
        echo $e;
    }
}

?>
