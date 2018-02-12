<?php

if(isset($_POST['submit'])) {
	$errorManager = addSubFamily($_POST['codeSubFamily'], $_POST['labelSubFamily'], $_GET['add_subFamily']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=machine&familyManagement');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<body>
<form action="" method="post">
	<input type="text" placeholder="<?=$lang['subFamily_label']?>" name="labelSubFamily"/>
	<input type="text" placeholder="<?=$lang['subFamily_code']?>" name="codeSubFamily"/>
	<input type="submit" value="<?=$lang["submit"]?>" name="submit">
</form>
</body>