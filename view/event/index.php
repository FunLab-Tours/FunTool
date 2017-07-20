<?php
    // TODO : delete HTML in subpages.
    loadModules("event");

    if(isset($_GET['idEdit'])) {
        include("editEvent.php");
    }
    else if(isset($_GET['idDelete'])) {
        include("deleteEvent.php");
    }
    else if (isset($_GET['idInfo'])){
        include("infoEvent.php");
    }
    else {
        include("addEvent.php");
        include("listEvent.php");
    }

?>