<?php
    loadModules("user");
    loadModules("picture");

    if(isset($_GET['editUser']))
        include("descriptionEdit.php");
    else if(isset($_GET['editPass']))
        include("passwordEdit.php");
    else
        include("description.php");