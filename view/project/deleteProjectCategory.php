<?php

    try {
        deleteProjectCategoryIncludeIn($_GET['idDeleteProjectCategory']);
        deleteProjectCategory($_GET['idDeleteProjectCategory']);
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

    header('Location: index.php?page=project&listProjectCategory=0');

?>