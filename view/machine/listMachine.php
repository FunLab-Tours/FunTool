<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["machinePicture"]?></td>
		<td><?=$lang["codeMachineInput"]?></td>
		<td><?=$lang["machineShortLabel"]?></td>
		<td><?=$lang["machineLongLabel"]?></td>
		<td><?=$lang["machineUsePrice"]?></td>
		<td><?=$lang["machineSerialNumber"]?></td>
		<td><?=$lang["machineManufacturer"]?></td>
		<td><?=$lang["machineComment"]?></td>
		<td><?=$lang["machineDocLink1"]?></td>
		<td><?=$lang["machineDocLink2"]?></td>
		<td><?=$lang["machineFamily"]?></td>
		<td><?=$lang["machineMaterials"]?></td>
	</tr>

	<?php
	foreach(getMachineList() as $row) {
	?>
	<tr>
		<?php
		if(getPicture($row['idPicture']) != null) { ?>
			<td><img src="<?=getPicture($row['idPicture'])['picture']?>"
					 alt="<?=getPicture($row['idPicture'])['pictureDescription']?>"</td>
			<?php
		}
		else {
			?>
			<td></td> <?php
		}
		?>

		<td><?=$row['codeMachine']?></td>
		<td><?=$row['shortLabel']?></td>
		<td><?=$row['longLabel']?></td>
		<td><?=$row['machineUsePrice']?>
			<?php
			if($row['machineUsePrice'] == 1)
				echo $lang['funnie'];
			else
				echo $lang['funnies'];
			?></td>
		<td><?=$row['serialNumber']?></td>
		<td><?=$row['manufacturer']?></td>
		<td><?=$row['comment']?></td>
		<td><?=$row['docLink1']?></td>
		<td><?=$row['docLink2']?></td>
		<td><?=getFamilyLabel($row['idFamily'])?></td>

		<td>
			<?php
			$membershipFrameList = (array)getMaterialsMachine($row['idMachine']);

			if($membershipFrameList && $membershipFrameList > 0)
				foreach($membershipFrameList as $material)
					echo $material['labelMat'] . " ; ";
			?>
		</td>
		<td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a>
			| <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>"
				 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a></td>
		<?php
		}
		?>
</table>
