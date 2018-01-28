<?php

    try {
        deletePictureLinkToProject($_GET['idDelete']);
        deleteProjectIncludeIn($_GET['idDelete']);
        deleteProjectParticipate($_GET['idDelete']);
        deleteProject($_GET['idDelete']);
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    header('Location: index.php?page=project');

?>