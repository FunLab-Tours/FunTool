<?php
    deleteProject($_GET['idDelete']);
    header('Location: index.php?page=project');
?>