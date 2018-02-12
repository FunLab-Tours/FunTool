<?php

if(isset($_POST['submit'])) {
	$errorManager = editFamily($_GET['idEditFamily'], $_POST['codeFamily'], $_POST['labelFamily']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=machine&familyManagement');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<body>
<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["family_label"]?></td>
		<td><?=$lang["family_code"]?></td>
		<td><?=$lang["family_nbr_sub"]?></td>
	</tr>

	<?php
	foreach(getFamilyList() as $row) {
		if($row['idFamily'] == $_GET['idEditFamily']) {
			?>
			<form method="POST" action="">
				<input type="text" placeholder="<?=$lang['family_label']?>" name="labelFamily" value="<?=$row['familyLabel']?>"/>
				<input type="text" placeholder="<?=$lang['family_code']?>" name="codeFamily" value="<?=$row['familyCode']?>"/>
				<?
				countNbrSubFamily($row['idFamily']) ?>
				<input type="submit" value="<?=$lang["submit"]?>" name="submit">
			</form>
			<?php
		}
		else {
			?>
			<tr>
				<td><?=$row['familyLabel']?></td>
				<td><?=$row['familyCode']?></td>
				<td><?=countNbrSubFamily($row['idFamily'])?></td>
				<td><a href="index.php?page=machine&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a> | <a
							href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>"
							onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a></td>
			</tr>
			<?php
		}
	}
	?>

</table>
<a href="?page=machine&add_family"><?=$lang["add_family"]?></a>
</body>
