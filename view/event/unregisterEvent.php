<?php
$userFunniesLeft = (currentUserFunnies($_COOKIE["id"]))+(ticketPrice($_GET["idUnregister"]));

if($userFunniesLeft>=0){
userUnregistrationToEvent($_COOKIE["id"],$_GET["idUnregister"]);
updateUserFunnies($_COOKIE["id"],$userFunniesLeft);
}
header('Location: index.php?page=event');
?>