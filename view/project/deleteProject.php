<?php
    deletePictureLinkToProject($_GET['idDelete']);
    deleteProject($_GET['idDelete']);
    header('Location: index.php?page=project');
?>
