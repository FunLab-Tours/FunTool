<?php
    // TODO : use private key from config.php.
    // TODO : use default funnies from config.php.
    // TODO : add profile picture.

    include('include/config.php');

    function isValidUser($login, $password) {
        global $DB_DB;
        $request = $DB_DB->prepare('SELECT COUNT(login) as nb_entry, password FROM user WHERE login = :login');

        try {
            $request->execute(array(
                'login' => $login
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        $result = $request->fetch();

        if(password_verify($password, $result['password']) && $result['nb_entry'] == 1)
            return true;
        return false;
    }

    function connectUser($login) {
        global $DB_DB;
        $request = $DB_DB->prepare('SELECT idUser FROM User WHERE login = :login');

        try {
            $request->execute(array(
                'login' => $login,
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        $result = $request->fetch();

        $privateKey = "thisisaprivatekey";

        setcookie("id", $result['idUser'], time() + 300000, "/");
        setcookie("token", sha1($result['idUser'] . $privateKey), time() + 30000, "/");
    }

    function isValidSignOn() {
        if(isset($_POST['login']) && isset($_POST['password'])
            && isset($_POST['passwordChecker']) && isset($_POST['firstName'])
            && isset($_POST['name']) && isset($_POST['telephone'])
            && isset($_POST['adressL1']) && isset($_POST['zipCode'])
            && isset($_POST['town']) && isset($_POST['country'])
            && isset($_POST['email']) && isset($_POST['birthDate'])) {

            if(!isValidNewLogin($_POST['login']))
                return false;

            if(!isValidPassword($_POST['password'], $_POST['passwordChecker']))
                return false;

            if(!isValidFirstName($_POST['firstName']))
                return false;

            if(!isValidName($_POST['name']))
                return false;

            if(!isValidTelephone($_POST['telephone']))
                return false;

            if(!isValidAdressL1($_POST['adressL1']))
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

    function isValidNewLogin($login) {
        global $DB_DB;
        $request = $DB_DB->prepare('SELECT COUNT(login) as nb_entry FROM User WHERE login = :login');

        if($login == "")
            return false;

        if(!preg_match("#^[a-zA-Z0-9]{3,}$#", $login))
            return false;

        try {
            $request->execute(array(
                'login' => $login
            ));
        }
        catch(Exception $e) {
            echo $e;
        }

        $result = $request->fetch();
        if($result['nb_entry'] == 1)
            return false;

        return true;
    }

    function isValidPassword($password, $passwordConfirmation) {
        if($password == "")
            return false;

        if(strlen($password) < 8 || strcmp($password, $passwordConfirmation) != 0)
            return false;

        return true;
    }

    function isValidFirstName($firstName) {
        if($firstName == "")
            return false;

        if(!preg_match("#^([a-zA-Z]|[- ]){3,}$#", $firstName))
            return false;

        return true;
    }

    function isValidName($name) {
        if($name == "")
            return false;

        if(!preg_match("#^([a-zA-Z]|[- ]){3,}$#", $name))
            return false;

        return true;
    }

    function isValidTelephone($telephone) {
        if($telephone == "")
            return false;

        if(!preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $telephone))
            return false;

        return true;
    }

    function isValidAdressL1($adressL1) {
        if($adressL1 == "")
            return false;
        return true;
    }

    function isValidZipCode($zipCode) {
        if($zipCode == "")
            return false;

        if(!preg_match("#^[0-9]{5}$#", $zipCode))
            return false;

        return true;
    }

    function isValidTown($town) {
        if($town == "")
            return false;

        if(!preg_match("#^[a-zA-Z]{3,}$#", $town))
            return false;

        return true;
    }

    function isValidCountry($country) {
        if($country == "")
            return false;

        if(!preg_match("#^[a-zA-Z]{3,}$#", $country))
            return false;

        return true;
    }

    function isValidEmail($email) {
        if($email == "")
            return false;

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
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
                        $picture) {
        global $DB_DB;

        $inscriptionActiveListBoolean = ($inscriptionActiveList == "true") ? 1 : 0;
        $inscriptionNewsBoolean = ($inscriptionNews == "true") ? 1 : 0;

        // First of all, we add the profile picture.
        $request = $DB_DB->prepare('INSERT INTO Picture (picture, pictureDescription, categoryPicture)
                                           VALUE (:picture, :pictureDescription, :categoryPicture)');
        try {
            $request->execute(array(
                'picture' => $picture,
                'pictureDescription' => $login,
                'categoryPicture' => "ProfilUser"
            ));

            $idPicture = $DB_DB->lastInsertId();
        }
        catch(Exception $e) {
            $idPicture = NULL;
        }

        // Then, we add the user.
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
                'password' => password_hash($password, PASSWORD_DEFAULT),
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
                'nbFunnies' => $nbFunnies,
                'inscriptionActiveList' => $inscriptionActiveListBoolean,
                'inscriptionNews' => $inscriptionNewsBoolean,
                'idPicture' => $idPicture
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

    function getUser($id){
        global  $DB_DB;
        return $DB_DB->query('SELECT * FROM User WHERE idUser = '.$id)->fetch();
    }

    function editUser(  $firstName,
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
                        $inscriptionActiveList,
                        $inscriptionNews,
                        $picture) {
        global $DB_DB;

        $inscriptionActiveListBoolean = ($inscriptionActiveList == "true") ? 1 : 0;
        $inscriptionNewsBoolean = ($inscriptionNews == "true") ? 1 : 0;

        $login = $DB_DB->query('SELECT login FROM User WHERE idUser = '.$_COOKIE['id'])->fetch()[0];

        // First, we modify the profile picture if needed.
        $idPicture = $DB_DB->query('SELECT idPicture
                                    FROM Picture
                                    WHERE picture
                                    LIKE '.$picture.' AND pictureDescription
                                    LIKE \"Avatar for user '.$login.'\"');

        if($idPicture == null) {
            $request = $DB_DB->prepare('INSERT INTO Picture (picture, pictureDescription, categoryPicture)
                                                   VALUE (:picture, :pictureDescription, :categoryPicture)');
            try {
                $request->execute(array(
                    'picture' => $picture,
                    'pictureDescription' => "Avatar for user " . $login,
                    'categoryPicture' => "ProfilUser"
                ));

                $idPicture = $DB_DB->lastInsertId();
            }
            catch (Exception $e) {
                $idPicture = NULL;
            }
        }

        // Then we add the user.
        $request = $DB_DB->prepare('UPDATE User SET firstName = :firstName,
                                                    name = :name,
                                                    telephone = :telephone,
                                                    adressL1 = :adressL1,
                                                    adressL2 = :adressL2,
                                                    adressL3 = :adressL3,
                                                    zipCode = :zipCode,
                                                    town = :town,
                                                    country = :country,
                                                    email = :email,
                                                    emailBis = :emailBis,
                                                    birthDate = :birthDate,
                                                    inscriptionActiveList = :inscriptionActiveList,
                                                    inscriptionNews = :inscriptionNews,
                                                    idPicture = :idPicture
                                     WHERE idUser = '.$_COOKIE['id']);

        try {
            $request->execute(array(
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
                'inscriptionActiveList' => $inscriptionActiveListBoolean,
                'inscriptionNews' => $inscriptionNewsBoolean,
                'idPicture' => $idPicture
            ));
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function editPassword($old, $new)
    {
        global $DB_DB;
        $password = $DB_DB->query('SELECT password FROM user WHERE idUser = '.$_COOKIE['id'])->fetch()[0];

        var_dump($password);
        var_dump(password_hash($old, PASSWORD_DEFAULT));
        var_dump(strcmp($old, $password));

        if(password_verify($old, $password)) {
            $request = $DB_DB->prepare('UPDATE user SET user.password = :new WHERE idUser = :id');
            $request->execute(array(
                'new' => password_hash($new, PASSWORD_DEFAULT),
                'id' => $_COOKIE['id']
            ));

            return true;
        }
        return false;
    }

?>