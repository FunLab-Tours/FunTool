<?php
    // TODO : encode password.
    // TODO : add profile picture.
    // TODO : use private key from config.php.

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

            if($_POST['login'] != "" && $_POST['password'] != ""
                && $_POST['passwordChecker'] != "" && $_POST['firstName'] != ""
                && $_POST['name'] != "" && $_POST['telephone'] != ""
                && $_POST['adressL1'] != "" && $_POST['zipCode'] != ""
                && $_POST['town'] != "" && $_POST['country'] != ""
                && $_POST['email'] != "" && $_POST['birthDate'] != "") {

                return true;
            }

        }
        return false;
    }

    function addUser() {
        global $DB_DB;

        $DEFAULT_FUNNIES = 5; // TODO : use default funnies from config.php.

        $inscriptionActiveList = ($_POST['inscriptionActiveList'] == "true") ? 1 : 0;
        $inscriptionNews = ($_POST['inscriptionNews'] == "true") ? 1 : 0;

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
                'login' => $_POST['login'],
                'password' => $_POST['password'],
                'firstName' => $_POST['firstName'],
                'name' => $_POST['name'],
                'telephone' => $_POST['telephone'],
                'adressL1' => $_POST['adressL1'],
                'adressL2' => $_POST['adressL2'],
                'adressL3' => $_POST['adressL3'],
                'zipCode' => $_POST['zipCode'],
                'town' => $_POST['town'],
                'country' => $_POST['country'],
                'email' => $_POST['email'],
                'emailBis' => $_POST['emailBis'],
                'birthDate' => $_POST['birthDate'],
                'nbFunnies' => $DEFAULT_FUNNIES,
                'inscriptionActiveList' => $inscriptionActiveList,
                'inscriptionNews' => $inscriptionNews,
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
