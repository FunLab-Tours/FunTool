<?php
try{
    foreach (selectAllUsersInEvent($_GET['idDelete']) as $user) {
        userUnregistrationToEvent($user['idUser'],$_GET['idDelete']);
    } 
    deleteEvent($_GET['idDelete']);
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
    header('Location: index.php?page=event');

?>
