<?php
if(isset($_POST['submit']) && isset($_POST['priceUnit']) && isset($_POST['unit'])) {
	assignCostUnit($_GET['edit'], $_POST['priceUnit'], $_POST['unit']);
	header('Location: index.php?page=materials&costUnit=1');
}

?>

<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang['labelMat']?></td>
		<td><?=$lang['docLink']?></td>
		<td><?=$lang['comment']?></td>
		<td><?=$lang['priceUnit']?></td>
		<td><?=$lang['unit']?></td>
	</tr>

	<?php
	$listMaterials = (array)listMaterials();

	if($listMaterials && $listMaterials > 0)
		foreach($listMaterials as $material) { ?>
			<tr>
				<td><?=$material['labelMat']?></td>
				<td><?=$material['docLink']?></td>
				<td><?=$material['comment']?></td>
				<?php
				if($material['idMat'] == $_GET['edit']) { ?>
					<form action="" method="POST">
						<label for="number"><?=$lang['priceByUnit']?> : </label><input id = "number" type="number" name="priceUnit" value="<?=getCostUnitMat($material['idMat'])['costUnit']?>"/>
						<label for="text"><?=$lang['unit']?> : </label><input id = "text" type="text" name="unit" value="<?=getCostUnitMat($material['idMat'])['unit']?>"/>
						<input type="submit" value="<?=$lang["submit"]?>" name="submit">
					</form>
				<?php }
				else { ?>
					<td><?=getCostUnitMat($material['idMat'])['costUnit']?></td>
					<td><?=getCostUnitMat($material['idMat'])['unit']?></td>
					<td>
						<a href="index.php?page=materials&costUnit=0&edit=<?=$material['idMat']?>"><?=$lang['edit']?></a>
					</td>
				<?php } ?>
			</tr>
		<?php } ?>
</table>
