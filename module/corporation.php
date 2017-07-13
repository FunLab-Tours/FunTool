<?php

function addCorporation($corporateName, $logo, $telephone, $adressL1, $adressL2,$adressL3,$zipCode, $town, $country, $email, $nbFunnies)
    {
        global $DB_DB;
        $stmt = $DB_DB->prepare("INSERT INTO corporation (corporateName, logo, telephone, adressL1, adressL2, adressL3, zipCode, town, country, email, nbFunnies) VALUES (:corporateName, :logo, :telephone, :adressL1, :adressL2, :adressL3, :zipCode, :town, :country, :email, :nbFunnies)");


    try {
        $stmt->execute(array(
            'corporateName' => $_POST['corporateName'],
            'logo' => $_POST['logo'],
            'telephone' => $_POST['telephone'],
            'adressL1' => $_POST['adressL1'],
            'adressL2' => $_POST['adressL2'],
            'adressL3' => $_POST['adressL3'],
            'zipCode' => $_POST['zipCode'],
            'town' => $_POST['town'],
            'country' => $_POST['country'],
            'email' => $_POST['email'],
            'nbFunnies' => $_POST['nbFunnies'],            
        ));

        echo "Corporation Added !";
    }

            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }


function deleteCorporation($idCorporation)
    {
        global $DB_DB;
        $stmt = $DB_DB->prepare("DELETE FROM corporation WHERE idCorporation=:idCorporation");
    try {
        $request->execute(array(
            'idCorporation' => $_POST['idCorporation']
        ));

        echo "Corporation deleted !";
    }
        
            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }

function updateCorporation($idCorporation, $corporateName, $logo, $telephone, $adressL1, $adressL2,$adressL3,$zipCode, $town, $country, $email, $nbFunnies)
{    
        global $DB_DB;
        $stmt = $DB_DB->prepare("UPDATE corporation SET corporateName = :corporateName, logo = :logo, telephone = :telephone, adressL1 = :adressL1, adressL2 = :adressL2, adressL3 = :adressL3, zipCode = :zipCode , town = :town, country = :country, email = :email, nbFunnies = :nbFunnies WHERE idCorporation = :idCorporation");
            try
                {
        $stmt->execute(array(
            'corporateName' => $_POST['corporateName'],
            'logo' => $_POST['logo'],
            'telephone' => $_POST['telephone'],
            'adressL1' => $_POST['adressL1'],
            'adressL2' => $_POST['adressL2'],
            'adressL3' => $_POST['adressL3'],
            'zipCode' => $_POST['zipCode'],
            'town' => $_POST['town'],
            'country' => $_POST['country'],
            'email' => $_POST['email'],
            'nbFunnies' => $_POST['nbFunnies'],            
        ));
            echo "Corporation updated !";
                }
        
            catch(Exception $e)
                {
                    echo $e;
                    exit;
                }
    }

function listAllCorporation()
    {
        global $DB_DB;
        $sql = "SELECT * FROM corporation";
        $result = $DB_DB->query($sql);
        return $result;
    }
?>
