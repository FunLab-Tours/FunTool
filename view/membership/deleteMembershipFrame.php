<?php

$errorManager = deleteMembershipFrame($_GET['idFrameDelete']);

if($errorManager == "" || ($errorManager && $errorManager > 0))
	header('Location: index.php?page=membership&listMembershipFrame');
else if($errorManager < 0)
	echo $error[$errorManager];
