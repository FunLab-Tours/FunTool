<?php
    // TODO : delete HTML in subpages.
    loadModules("lab");

    if(isset($_GET['idEdit'])) {
        include("editLab.php");
    }
    else if(isset($_GET['idDelete'])) {
        include("deleteLab.php");
    }
    else {
        include("addLab.php");
    }

?>
