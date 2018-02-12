<?php

if(isset($_POST['submit']) && $_POST['labelMat'] != "" && $_POST['codeMat'] != "" && isset($_POST['priceMat']) && $_POST['priceMat'] >= 0) {
	$errorManager = editMaterial($_GET['editMaterial'], $_POST['labelMat'], $_POST['codeMat'], $_POST['priceMat'], $_POST['docLink'], $_POST['comment']);

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
	</tr>

	<?php
	$listMaterials = (array)listMaterials();

	if($listMaterials && $listMaterials > 0)
		foreach($listMaterials as $material) {
			if($material['idMat'] == $_GET['editMaterial']) { ?>
				<form action="" method="POST">
					<input id="labelMat" placeholder="<?=$lang['labelMat']?>" value="<?=$material['labelMat']?>" name="labelMat"/>
					<input id="codeMat" placeholder="<?=$lang['codeMat']?>" value="<?=$material['codeMat']?>" name="codeMat"/>
					<input id="priceMat" placeholder="<?=$lang['priceMat']?>" type="number" value="<?=$material['priceMat']?>" name="priceMat"/>
					<input id="docLink" placeholder="<?=$lang['docLink']?>" value="<?=$material['docLink']?>" name="docLink"/>
					<input id="comment" placeholder="<?=$lang['comment']?>" value="<?=$material['comment']?>" name="comment"/>
					<input id="submit" type="submit" value="<?=$lang["submit"]?>" name="submit">
				</form>
			<?php } else { ?>
				<tr>
					<td><?=$material['labelMat']?></td>
					<td><?=$material['codeMat']?></td>
					<td><?=$material['priceMat']?></td>
					<td><?=$material['docLink']?></td>
					<td><?=$material['comment']?></td>
					<td>
						<a href="index.php?page=materials&&material=0editMaterial=<?=$material['idMat']?>"><?=$lang['edit']?></a>
						| <a href="index.php?page=materials&&material=0deleteMaterial=<?=$material['idMat']?>"
							 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a>
					</td>
				</tr>
			<?php }
		} ?>
</table>
