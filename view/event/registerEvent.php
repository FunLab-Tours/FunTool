<?php

    try {
        if(currentUserFunnies($_COOKIE["id"]) >= ticketPrice($_GET["idRegister"])) {
            userRegistrationToEvent($_COOKIE["id"],$_GET["idRegister"]);
            header('Location: index.php?page=event');
        }
        else {
            header('Location: index.php?page=funnies');
        }
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

?>