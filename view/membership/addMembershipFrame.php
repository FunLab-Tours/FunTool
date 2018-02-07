<?php

$entryDate = date('Ymd');

if(isset($_POST['submit'])) {
	$errorManager = addMembershipFrame($_POST['bonusMembership'], $entryDate, $_POST['frameName'], $_POST['framePrice'], $_POST['frameComment']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=membership&listMembershipFrame');
	else if($errorManager > 0)
		echo $error[$errorManager];
}

?>


<form action="" method="POST">
	<input type="text" placeholder="<?=$lang["frameName"]?>" name="frameName"/>
	<br><br>
	<input type="text" placeholder="<?=$lang["frameComment"]?>" name="frameComment" value=""/>
	<br><br>
	<input type="number" min="0" placeholder="<?=$lang["framePrice"]?>" name="framePrice"/>
	<br><br>
	<input type="number" min="0" placeholder="<?=$lang["bonusMembership"]?>" name="bonusMembership"/>
	<br><br>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>
