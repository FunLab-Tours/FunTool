<?php
    loadModules("machine");
	include("static/machineMenu.php");
	
    if(isset($_GET['idEdit']))
        include("editMachine.php");
    else if(isset($_GET['idDelete']))
        include("deleteMachine.php");
    else if(isset($_GET['addMachine']))
		include("addMachine.php");
	else if(isset($_GET['familyManagement']));
	else 
        include("listMachine.php");
?>
