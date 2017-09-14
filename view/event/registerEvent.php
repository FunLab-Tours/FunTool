<?php
try{
    if(currentUserFunnies($_COOKIE["id"]) >= ticketPrice($_GET["idRegister"])){
        userRegistrationToEvent($_COOKIE["id"],$_GET["idRegister"]);
    }
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
}
    header('Location: index.php?page=event');
?>