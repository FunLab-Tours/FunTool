<?php

    loadModules("user");
    loadModules("rightsAndRoles");

    include("static/menu.php");

    // Roles.
    if(isset($_GET['listRoles']))
        include("listRoles.php");
    else if(isset($_GET['editRole']))
        include("editRoles.php");
    else if(isset($_GET['deleteRole']))
        include("deleteRole.php");

    // Rights.
    else if(isset($_GET['listRights']))
        include("listRights.php");
    else if(isset($_GET['editRight']))
        include("editRight.php");
    else if(isset($_GET['deleteRight']))
        include("deleteRight.php");

    // Users.
    else if(isset($_GET['editUser']))
        include("roleUserEdit.php");
    else
        include("listUser.php");
