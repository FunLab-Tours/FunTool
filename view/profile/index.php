<?php
    loadModules("user");
    loadModules("picture");

    include("static/menu.php");

    /*Skills Management*/
    if(isset($_GET['skills']))
        include("skills/index.php");
    /*Knowledge Management*/
    else if(isset($_GET['knowledge']))
        include("knowledges/index.php");
    /*User*/
    else if (isset($_GET['editUser']))
        include("descriptionEdit.php");
    else if (isset($_GET['editPass']))
        include("passwordEdit.php");
    else if (isset($_GET['usersSkills']))
        include("usersSkills/index.php");
    else
        include("description.php");