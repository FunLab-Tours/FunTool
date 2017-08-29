<?php
updateUserFunnies($_COOKIE['id'],$_POST['newBalance']);
header('Location: index.php?page=funnies');
?>