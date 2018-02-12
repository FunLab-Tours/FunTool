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
			<td><?=getCostUnitMat($material['idMat'])['costUnit']?></td>
			<td><?=getCostUnitMat($material['idMat'])['unit']?></td>
			<td>
				<a href="index.php?page=materials&costUnit=0&edit=<?=$material['idMat']?>"><?=$lang['edit']?></a>
			</td>
		</tr>
	<?php } ?>
</table>
