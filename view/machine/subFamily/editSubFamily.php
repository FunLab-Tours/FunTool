<?php

if(isset($_POST['submit'])) {
	$errorManager = editSubFamily($_GET['idEditSubFamily'], $_POST['codeSubFamily'], $_POST['labelSubFamily']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=machine&familyManagement');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<body>
<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["subFamily_label"]?></td>
		<td><?=$lang["subFamily_code"]?></td>
	</tr>

	<?php
	foreach(getAllSubFamilyList() as $row) {
		if($row['idSubFamily'] == $_GET['idEditSubFamily']) {
			?>
				<form method="POST" action="">
					<input placeholder="<?=$lang['subFamily_label']?>" type="text" name="labelSubFamily" value="<?=$row['labelSubFamily']?>"/>
					<input placeholder="<?=$lang['subFamily_code']?>" type="text" name="codeSubFamily" value="<?=$row['codeSubFamily']?>"/>
					<input type="submit" value="<?=$lang["submit"]?>" name="submit">
				</form>
			<?php
		}
		else {
			?>
			<tr>
				<td><?=$row['labelSubFamily']?></td>
				<td><?=$row['codeSubFamily']?></td>
				=
				<td><a href="index.php?page=machine&idEditSubFamily=<?=$row['idSubFamily']?>"><?=$lang['edit']?></a> |
					<a href="index.php?page=machine&idDeleteSubFamily=<?=$row['idSubFamily']?>"
					   onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
			</tr>
			<?php
		}
	}
	?>

</table>
</body>
