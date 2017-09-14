<?php
try{
userUnregistrationToEvent($_COOKIE["id"],$_GET["idUnregister"]);
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
}
header('Location: index.php?page=event');
?>