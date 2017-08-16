<?php

    if(isset($_COOKIE['lang']) && file_exists("lang/" . $_COOKIE['lang'] . ".php")){
        include($base_uri ."/lang/" . $_COOKIE['lang'] . ".php");
    }
    else{
        include($base_uri . "/lang/fr.php");
    }

?>
