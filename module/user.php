<?php
    include('include/config.php');

    // TODO : check all forms format.
    // TODO : encode and salt passwords.

    // TODO : use private key from config.php.
    // TODO : use default funnies from config.php.
    // TODO : add profile picture.

    function isValidUser($login, $password) {
        global $DB_DB;

        $request = $DB_DB->prepare('SELECT COUNT(login) as nb_entry FROM User WHERE login = :login && password = :password');

        try {
            $request->execute(array(
                'login' => $login,
                'password' => $password
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        if($request->fetch()['nb_entry'] == 1)
            return true;
        return false;
    }

    function connectUser($login, $password) {
        global $DB_DB;

        $request = $DB_DB->prepare('SELECT idUser FROM User WHERE login = :login && password = :password');

        try {
            $request->execute(array(
                'login' => $login,
                'password' => $password
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        $result = $request->fetch();

        $privateKey = "thisisaprivatekey";

        setcookie("id", $result['idUser'], time() + 30000, "/");
        setcookie("token", sha1($result['idUser'] . $privateKey), time() + 30000, "/");
    }

    function isValidSignOn() {
        if(isset($_POST['login']) && isset($_POST['password'])
            && isset($_POST['passwordChecker']) && isset($_POST['firstName'])
            && isset($_POST['name']) && isset($_POST['telephone'])
            && isset($_POST['adressL1']) && isset($_POST['zipCode'])
            && isset($_POST['town']) && isset($_POST['country'])
            && isset($_POST['email']) && isset($_POST['birthDate'])) {

            if(!isValidLogin($_POST['login']))
                return false;

            if(!isValidPassword($_POST['password']))
                return false;

            if(!isValidFirstName($_POST['firstName']))
                return false;

            if(!isValidName($_POST['name']))
                return false;

            if(!isValidTelephone($_POST['telephone']))
                return false;

            if(!isValidAdressL1($_POST['adressL1']))
                return false;

            if(!isValidAdressL2($_POST['adressL2']))
                return false;

            if(!isValidAdressL3($_POST['adressL3']))
                return false;

            if(!isValidZipCode($_POST['zipCode']))
                return false;

            if(!isValidTown($_POST['town']))
                return false;

            if(!isValidCountry($_POST['country']))
                return false;

            if(!isValidEmail($_POST['email']))
                return false;

            if(!isValidBirthDate($_POST['birthDate']))
                return false;

            return true;
        }
        return false;
    }

    function isValidLogin($login) {
        if($login == "")
            return false;
        return true;
    }

    function isValidPassword($password) {
        if($password == "")
            return false;
        return true;
    }

    function isValidFirstName($firstName) {
        if($firstName == "")
            return false;
        return true;
    }

    function isValidName($name) {
        if($name == "")
            return false;
        return true;
    }

    function isValidTelephone($telephone) {
        if($telephone == "")
            return false;
        return true;
    }

    function isValidAdressL1($adressL1) {
        if($adressL1 == "")
            return false;
        return true;
    }

    function isValidAdressL2($adressL2) {
        if($adressL2 == "")
            return false;
        return true;
    }

    function isValidAdressL3($adressL3) {
        if($adressL3 == "")
            return false;
        return true;
    }

    function isValidZipCode($zipCode) {
        if($zipCode == "")
            return false;
        return true;
    }

    function isValidTown($town) {
        if($town == "")
            return false;
        return true;
    }

    function isValidCountry($country) {
        if($country == "")
            return false;
        return true;
    }

    function isValidEmail($email) {
        if($email == "")
            return false;
        return true;
    }

    function isValidBirthDate($birthDate) {
        if($birthDate == "")
            return false;
        return true;
    }
 
    function addUser(   $login,
                        $password,
                        $firstName,
                        $name,
                        $telephone,
                        $adressL1,
                        $adressL2,
                        $adressL3,
                        $zipCode,
                        $town,
                        $country,
                        $email,
                        $emailBis,
                        $birthDate,
                        $nbFunnies,
                        $inscriptionActiveList,
                        $inscriptionNews,
                        $idPicture) {
        global $DB_DB;

        $DEFAULT_FUNNIES = 5;

        $inscriptionActiveListBoolean = ($inscriptionActiveList == "true") ? 1 : 0;
        $inscriptionNewsBoolean = ($inscriptionNews == "true") ? 1 : 0;

        $request = $DB_DB->prepare('INSERT INTO User( login,
                                                      password,
                                                      firstName,
                                                      name,
                                                      telephone,
                                                      adressL1,
                                                      adressL2,
                                                      adressL3,
                                                      zipCode,
                                                      town,
                                                      country,
                                                      email,
                                                      emailBis,
                                                      birthDate,
                                                      nbFunnies,
                                                      inscriptionActiveList,
                                                      inscriptionNews,
                                                      idPicture)
                                    VALUES( :login,
                                            :password,
                                            :firstName,
                                            :name,
                                            :telephone,
                                            :adressL1,
                                            :adressL2,
                                            :adressL3,
                                            :zipCode,
                                            :town,
                                            :country,
                                            :email,
                                            :emailBis,
                                            :birthDate,
                                            :nbFunnies,
                                            :inscriptionActiveList,
                                            :inscriptionNews,
                                            :idPicture)');

        try {
            $request->execute(array(
                'login' => $login,
                'password' => $password,
                'firstName' => $firstName,
                'name' => $name,
                'telephone' => $telephone,
                'adressL1' => $adressL1,
                'adressL2' => $adressL2,
                'adressL3' => $adressL3,
                'zipCode' => $zipCode,
                'town' => $town,
                'country' => $country,
                'email' => $email,
                'emailBis' => $emailBis,
                'birthDate' => $birthDate,
                'nbFunnies' => $DEFAULT_FUNNIES,
                'inscriptionActiveList' => $inscriptionActiveListBoolean,
                'inscriptionNews' => $inscriptionNewsBoolean,
                'idPicture' => NULL
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function disconnectUser() {
        unset($_COOKIE["id"]);
        unset($_COOKIE["token"]);

        setcookie("id", null, -1, '/');
        setcookie("token", null, -1, '/');
    }

?>
