<?php

/*
    if(isset($_COOKIE['lang']) && file_exists("lang/" . $_COOKIE['lang'] . ".php")) {
        include("lang/" . $_COOKIE['lang'] . ".php");
    }
    else {
        include("lang/fr.php");
    }
*/

?>

<?php
        if(isset($_COOKIE['lang']) && file_exists("lang/" . $_COOKIE['lang'] . ".php")) {
            include("lang/" . $_COOKIE['lang'] . ".php");
        }
        else {
            if(isset($_COOKIE['lang']) && file_exists("../lang/" . $_COOKIE['lang'] . ".php")) {
                include("../lang/" . $_COOKIE['lang'] . ".php");
            }
            else{
                if( file_exists("../lang/fr.php")){
                    include("../lang/fr.php");
                }
                else{
                    include("lang/fr.php");
                }
            }
        }

?>
