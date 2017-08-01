<?php
    loadModules("machine");
	loadModules("machineFamily");
	include("static/machineMenu.php");
	
    if(isset($_GET['idEdit'])){
        include("editMachine.php");
	}
    else if(isset($_GET['idDelete'])){
        include("deleteMachine.php");
	}
    else if(isset($_GET['addMachine'])){
		include("addMachine.php");
	}
	else if(isset($_GET['familyManagement'])){
		include("listFamily.php");
	}
	else if(isset($_GET['add_family'])){
		include("addFamily.php");
	}
	else if(isset($GET['idEditFamily'])){
		include("editFamily.php");
	}
	else if(isset($GET['idDeleteFamily'])){
		include("deleteFamily.php");
	}
	else 
        include("listMachine.php");
?>
