<?php
$userFunniesLeft = (currentUserFunnies($_COOKIE["id"]))-(ticketPrice($_GET["idRegister"]));

if($userFunniesLeft>=0){
userRegistrationToEvent($_COOKIE["id"],$_GET["idRegister"]);
updateUserFunnies($_COOKIE["id"],$userFunniesLeft);
}
header('Location: index.php?page=event');
?>