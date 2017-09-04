<?php
    loadModules("project");
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
    else {
        include("listProject.php");
    }
?>