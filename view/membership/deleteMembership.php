<?php
try{
    deleteMembership($_GET['idDeleteMembership']);
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
    header('Location: index.php?page=membership&listMembership=0');

?>