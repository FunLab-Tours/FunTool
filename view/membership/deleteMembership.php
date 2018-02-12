<?php

$errorManager = deleteMembership($_GET['idDeleteMembership']);

if($errorManager == "" || ($errorManager && $errorManager > 0))
	header('Location: index.php?page=membership&listMembership=0');
else if($errorManager < 0)
	echo $error[$errorManager];
