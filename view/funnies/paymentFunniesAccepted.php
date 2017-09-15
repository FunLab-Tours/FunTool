<?php
try{
    updateUserFunnies($_COOKIE['id'],$_POST['newBalance']);
}
catch(Exception $e)
{
    echo 'Message: ' .$e->getMessage();
}
header('Location: index.php?page=funnies');
?>