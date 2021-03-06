<?php

loadModules("machine/machine");
loadModules("machine/machineFamily");
loadModules("maintenance/maintenance");
loadModules("maintenance/historical");
loadModules("picture");
loadModules("materials");

include("static/machineMenu.php");

// Maintenance Management.
if(isset($_GET['maintenance']))
	include("maintenance/index.php");
// Family Management.
else if(isset($_GET['familyManagement']))
	include("family/listFamily.php");
else if(isset($_GET['add_family']))
	include("family/addFamily.php");
else if(isset($_GET['idEditFamily']))
	include("family/editFamily.php");
else if(isset($_GET['idDeleteFamily']))
	include("family/deleteFamily.php");
// SubFamily Management.
else if(isset($_GET['add_subFamily']))
	include("subFamily/addSubFamily.php");
else if(isset($_GET['idEditSubFamily']))
	include("subFamily/editSubFamily.php");
else if(isset($_GET['idDeleteSubFamily']))
	include("subFamily/deleteSubFamily.php");
// Machine management.
else if(isset($_GET['idEdit']))
	include("editMachine.php");
else if(isset($_GET['idDelete']))
	include("deleteMachine.php");
else if(isset($_GET['addMachine']))
	include("addMachine.php");
else if(isset($_GET['chooseImage']))
	include("picture/imageManagement.php");
else
	include("listMachine.php");
