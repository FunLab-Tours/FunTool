<?php

    if(isset($_GET['editMaterial']))
        include("editMaterial.php");
    else if(isset($_GET['deleteMaterial']))
        include("deleteMaterial.php");
    else include("listMaterials.php");

?>