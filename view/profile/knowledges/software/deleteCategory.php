<?php

    deleteSoftwareCategory($_GET['deleteCategory']);
    header('Location: index.php?page=profile&knowledge=1&categories=1');

?>