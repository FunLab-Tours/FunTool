<?php
try{
    deleteLab($_GET['idDelete']);
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
    header('Location: index.php?page=lab');

?>
