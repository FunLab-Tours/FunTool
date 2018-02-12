<?php

if(isset($_POST['submit']) && $_POST['labelMat'] != "" && $_POST['codeMat'] != "" && isset($_POST['priceMat']) && $_POST['priceMat'] >= 0) {
	$errorManager = addMaterial($_POST['labelMat'], $_POST['codeMat'], $_POST['priceMat'], $_POST['docLink'], $_POST['comment']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=materials&material');
	else
		echo $error[$errorManager];
}

?>

<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang['labelMat']?></td>
		<td><?=$lang['codeMat']?></td>
		<td><?=$lang['priceMat']?></td>
		<td><?=$lang['docLink']?></td>
		<td><?=$lang['comment']?></td>
		<td><?=$lang['dateEntry']?></td>
	</tr>

	<?php
	$listMaterials = (array)listMaterials();

	if($listMaterials && $listMaterials > 0)
		foreach($listMaterials as $material) { ?>
			<tr>
				<td><?=$material['labelMat']?></td>
				<td><?=$material['codeMat']?></td>
				<td><?=$material['priceMat']?></td>
				<td><?=$material['docLink']?></td>
				<td><?=$material['comment']?></td>
				<td><?=$material['dateEntry']?></td>
				<td>
					<a href="index.php?page=materials&material=0&editMaterial=<?=$material['idMat']?>"><?=$lang['edit']?></a>
					| <a href="index.php?page=materials&material=0&deleteMaterial=<?=$material['idMat']?>"
						 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a>
				</td>
			</tr>
		<?php } ?>

	<form action="" method="POST">
		<input placeholder="<?=$lang['labelMat']?>" name="labelMat"/>
		<input placeholder="<?=$lang['codeMat']?>" name="codeMat"/>
		<input placeholder="<?=$lang['priceMat']?>" type="number" name="priceMat"/>
		<input placeholder="<?=$lang['docLink']?>" name="docLink"/>
		<input placeholder="<?=$lang['comment']?>" name="comment"/>
		<input type="submit" value="<?=$lang["submit"]?>" name="submit">
	</form>
</table>
