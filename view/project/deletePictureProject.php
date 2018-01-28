<?php

    try {
        deletePictureLinkToProject($_GET['idDeletePicture']);
    }
    catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }

?>