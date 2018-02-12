<?php

if(isset($_POST['submit'])) {
	$errorManager = addFamily($_POST['codeFamily'], $_POST['labelFamily']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=machine&familyManagement');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<form action="" method="post">
	<input type="text" placeholder="<?=$lang['family_label']?>" name="labelFamily"/>
	<input type="text" placeholder="<?=$lang['family_code']?>" name="codeFamily"/>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>
