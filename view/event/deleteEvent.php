<?php
    foreach (selectAllUsersInEvent($_GET['idDelete']) as $user) {
        //var_dump($user);

        userUnregistrationToEvent($user['idUser'],$_GET['idDelete']);
    } 
    deleteEvent($_GET['idDelete']);
    //header('Location: index.php?page=event');

?>
