<?php

loadModules("user");
loadModules("picture");

include("static/menu.php");

// Skills management.
if(isset($_GET['skills']))
	include("skills/index.php");
// Knowledge management.
else if(isset($_GET['knowledge']))
	include("knowledge/index.php");
// User.
else if(isset($_GET['editUser']))
	include("descriptionEdit.php");
else if(isset($_GET['editPass']))
	include("passwordEdit.php");
else if(isset($_GET['usersSkills']))
	include("usersSkills/index.php");
else
	include("description.php");