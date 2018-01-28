<?php

    loadModules("materials");
    include("static/menu.php");

    if(isset($_GET['costUnit']))
        include("costUnit/index.php");
    else if(isset($_GET['material']))
        include("materials/index.php");
    else
        include("supplies/index.php");

?>