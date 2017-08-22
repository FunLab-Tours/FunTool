<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 18/08/2017
 * Time: 14:50
 */

loadModules("picture");
loadModules("user");
loadModules("searchUser");
loadModules("rightsAndRoles");
loadModules("skills");
loadModules("knowledges/knowledges");

if(isset($_GET["details"]))
    include("userCard.php");
else{
    include("searchMenu.php");
    if(isset($_GET["search"]))
        include("result.php");
    else
        include("listUser.php");
}
