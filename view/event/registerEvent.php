<?php
    if(currentUserFunnies($_COOKIE["id"]) >= ticketPrice($_GET["idRegister"])){
        userRegistrationToEvent($_COOKIE["id"],$_GET["idRegister"]);
    }

    header('Location: index.php?page=event');
?>