<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 16/08/2017
 * Time: 14:21
 */

loadModules("user");
loadModules("rightsAndRoles");

include("static/menu.php");

/*ROLES*/
if(isset($_GET['listRoles']))
    include("listRoles.php");
else if(isset($_GET['editRole']))
    include("editRoles.php");
else if(isset($_GET['deleteRole']))
    include("deleteRole.php");
/*RIGHTS*/
else if(isset($_GET['listRights']))
    include("listRights.php");
else if(isset($_GET['editRight']))
    include("editRight.php");
else if(isset($_GET['deleteRight']))
    include("deleteRight.php");
/*USERS*/
else if(isset($_GET['editUser']))
        include("roleUserEdit.php");
else include("listUser.php");