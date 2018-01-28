<?php

    try {
        userUnregistrationToEvent($_COOKIE["id"],$_GET["idUnregister"]);
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    header('Location: index.php?page=event');

?>