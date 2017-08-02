<?php
    if(isset($_POST['submit'])) {
		addFamily( $_POST['labelFamily'],
					$_POST['codeFamily']
            );
        header('Location: index.php?page=machine&familyManagement=0');
    }
?>

<body>
	<form action="" method="post">
		<input type="text" placeholder="<?=$lang['family_label']?>" name="labelFamily" />
		<input type="text" placeholder="<?=$lang['family_code']?>" name="codeFamily" />
		<input type="submit" value="<?=$lang["submit"]?>" name="submit">
	</form>
</body>