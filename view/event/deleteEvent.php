<?php
try{
    foreach (selectAllUsersInEvent($_GET['idDelete']) as $user) {
        userUnregistrationToEvent($user['idUser'],$_GET['idDelete']);
    } 
    deleteEvent($_GET['idDelete']);
}
catch(Exception $e)
{
    die('erreur : '.$e->getMessage());
}
    header('Location: index.php?page=event');

?>
