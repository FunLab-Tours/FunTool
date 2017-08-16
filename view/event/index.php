<?php
    // TODO : delete HTML in subpages.
    loadModules("event");

    include("static/eventMenu.php");

    if(isset($_GET['idEdit'])) {
        include("editEvent.php");
    }
    else if(isset($_GET['idDelete'])) {
        include("deleteEvent.php");
    }
    else if (isset($_GET['idInfo'])){
        include("infoEvent.php");
    }
    else if (isset($_GET['idRegister'])){
        include("registerEvent.php");
    }
    else if (isset($_GET['idUnregister'])){
        include("unregisterEvent.php");
    }
    else if (isset($_GET["addEvent"])){
        include("addEvent.php");
    }
    else {
        include("listEvent.php");
    }

?>