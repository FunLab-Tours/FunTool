<?php
    deletePictureLinkToProject($_GET['idDelete']);
    deleteProjectIncludeIn($_GET['idDelete']);
    deleteProjectParticipate($_GET['idDelete']);
    deleteProject($_GET['idDelete']);
    header('Location: index.php?page=project');
?>
