<?php

if(isset($_POST['submit']) && isset($_POST['material']) && isset($_POST['quantity'])) {
	$errorManager = setMaterialsQuantity($_POST['material'], $_POST['quantity']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=materials');
	else if($errorManager > 0)
		echo $error[$errorManager];
}

?>

<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang['labelMat']?></td>
		<td><?=$lang['codeMat']?></td>
		<td><?=$lang['lastRestock']?></td>
		<td><?=$lang['quantityInStock']?></td>
	</tr>
	<?php
	$listMaterials = (array)listMaterials();

	if($listMaterials && $listMaterials > 0)
		foreach($listMaterials as $material) {
			$stock = getMaterialStock($material['idMat']); ?>
			<tr>
				<td><?=$material['labelMat']?></td>
				<td><?=$material['codeMat']?></td>
				<td><?=$stock['dateUpdate']?></td>
				<td><?=$stock['supplies']?></td>
			</tr>
		<?php } ?>
</table>

<form method="POST" action="">
	<label for="chooseMat"><?=$lang['chooseMat']?></label>
	<select id="chooseMat" name="material">
		<option value="" disabled selected><?=$lang['chooseMat']?></option>
		<?php
		$listMaterials = (array)listMaterials();

		if($listMaterials && $listMaterials > 0)
			foreach($listMaterials as $material) { ?>
				<option value="<?=$material['idMat']?>"><?=$material['labelMat']?></option>
			<?php } ?>
	</select>
	<input type="number" placeholder="<?=$lang['quantity']?>" name="quantity">
	<input type="submit" value="<?=$lang['changeStock']?>" name="submit">
</form>
