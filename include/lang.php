<?php

    if(isset($_COOKIE['lang']) && file_exists("lang/" . $_COOKIE['lang'] . ".php")) {
        include("lang/" . $_COOKIE['lang'] . ".php");
    }
    else {
        include("lang/fr.php");
    }

?>
