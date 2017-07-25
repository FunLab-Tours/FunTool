<?php
    loadModules("machine");

    if(isset($_GET['idEdit']))
        include("editMachine.php");
    else if(isset($_GET['idDelete']))
        include("deleteMachine.php");
    else {
        include("addMachine.php");
        include("listMachine.php");
    }

?>
