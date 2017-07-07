<?php

function isValidSubmit() {
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['password']) && isset($_POST['passwordChecker']) && isset($_POST['telephoneNumber']) && isset($_POST['addressL1']) && isset($_POST['zipCode']) && isset($_POST['town']) && isset($_POST['country']) && isset($_POST['email']) && isset($_POST['birthDate']))
        if($_POST['firstName'] != "" && $_POST['lastName'] != "" && $_POST['password'] != "" && $_POST['passwordChecker'] != "" && $_POST['telephoneNumber'] != "" && $_POST['addressL1'] != "" && $_POST['zipCode'] != "" && $_POST['town'] != "" && $_POST['country'] != "" && $_POST['email'] != "" && $_POST['birthDate'] != "")
            return true;
    return false;
}

function addUser() {
    global $DB_DB;

    if($_POST['inscriptionNews'] == "true")
        $inscriptionNews = 1;
    else
        $inscriptionNews = 0;

    $request = $DB_DB->prepare('INSERT INTO User(firstName, name, corporateName, telephone, adressL1, adressL2, adressL3, zipCode, town, country, email, emailBis, birthDate, nbFunnies, inscriptionActiveList, inscriptionNews, idPicture) VALUES(:firstName, :name, :corporateName, :telephone, :adressL1, :adressL2, :adressL3, :zipCode, :town, :country, :email, :emailBis, :birthDate, :nbFunnies, :inscriptionActiveList, :inscriptionNews, :idPicture)');

    try {
        $request->execute(array(
            'firstName' => $_POST['firstName'],
            'name' => $_POST['lastName'],
            'corporateName' => "",
            'telephone' => $_POST['telephoneNumber'],
            'adressL1' => $_POST['addressL1'],
            'adressL2' => $_POST['addressL2'],
            'adressL3' => $_POST['addressL3'],
            'zipCode' => $_POST['zipCode'],
            'town' => $_POST['town'],
            'country' => $_POST['country'],
            'email' => $_POST['email'],
            'emailBis' => $_POST['email2'],
            'birthDate' => $_POST['birthDate'],
            'nbFunnies' => $DEFAULT_FUNNIES,
            'inscriptionActiveList' => 0,
            'inscriptionNews' => $inscriptionNews,
            'idPicture' => NULL
        ));

        echo "Ok !";
    }
    catch(Exception $e) {
        echo $e;
        exit;
    }
}

?>
