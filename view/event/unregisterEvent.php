<?php
userUnregistrationToEvent($_COOKIE["id"],$_GET["idUnregister"]);
header('Location: index.php?page=event');
?>