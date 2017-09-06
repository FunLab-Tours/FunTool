<?php
    loadModules("project");
    loadModules("machine/machine");
    include("static/projectMenu.php");

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
    else if (isset($_GET['addProject'])){
        include("addProject.php");
    }
    else if (isset($_GET['listProject'])){
        include("listProject.php");
    }
    else if (isset($_GET['listProjectCategory'])){
        include("listProjectCategory.php");
    }
    else if (isset($_GET['addProjectCategory'])){
        include("addProjectCategory.php");
    }
    else if (isset($_GET['idDeleteProjectCategory'])){
        include("deleteProjectCategory.php");
    }
    else if (isset($_GET['idEditProjectCategory'])){
        include("editProjectCategory.php");
    }
    else {
        include("listProject.php");
    }
?>