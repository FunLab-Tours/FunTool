<?php
try{
    deleteMembershipFrame($_GET['idFrameDelete']);
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
    header('Location: index.php?page=membership&listMembershipFrame=0');

?>