<?php

    loadModules("picture");
    loadModules("user");
    loadModules("searchUser");
    loadModules("rightsAndRoles");
    loadModules("skills");
    loadModules("knowledges/knowledges");
    loadModules("knowledges/softwares");

    include("static/menu.php");

    if(isset($_GET["details"]))
        include("userCard.php");
    else if(isset($_GET["search"]))
        include("searchMenu.php");
    else if(isset($_GET["result"])) {
        include("searchMenu.php");
        include("result.php");
    }
    else
        include("listUser.php");

?>