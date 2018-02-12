<?php

loadModules("materials");

include("static/menu.php");

//if(isset($_GET['costUnit'])) // TODO : delete this comment.
//	include("costUnit/index.php");
if(isset($_GET['material']))
	include("materials/index.php");
else
	include("supplies/index.php");
