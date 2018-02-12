<?php

include("static/maintenanceMenu.php");

if(isset($_GET['historical']))
	include("historical.php");
else
	include("maintenance.php");
