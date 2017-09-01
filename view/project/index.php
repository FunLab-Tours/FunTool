<?php
    // loadModules("project");

    if(isset($_GET['idEdit'])) {
        include("editProject.php");
    }
    else if(isset($_GET['idDelete'])) {
        include("deleteProject.php");
    }
    else if(isset($_GET['idDeletePicture'])) {
        include("deletePictureProject.php");
    }
    else if (isset($_GET['idInfo'])){
        include("infoProject.php");
    }
    else {
        include("addProject.php");
        include("listProject.php");
    }
?>