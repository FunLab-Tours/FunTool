<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["frameName"]?></td>
		<td><?=$lang["frameComment"]?></td>
		<td><?=$lang["framePrice"]?></td>
		<td><?=$lang["bonusMembership"]?></td>
		<td><?=$lang["entryDate"]?></td>
	</tr>

	<?php
	$materialsList = (array)listAllMembershipFrame();

	if($materialsList && $materialsList > 0)
		foreach($materialsList as $row) {
		?>
		<tr>
			<td><?=$row['frameName']?></td>
			<td><?=$row['frameComment']?></td>
			<td><?=$row['framePrice']?></td>
			<td><?=$row['bonusMembership']?></td>
			<td><?=$row['entryDate']?></td>
			<td><a href="index.php?page=membership&idFrameEdit=<?=$row['idMembershipFrame']?>"><?=$lang["edit"]?></a>
				| <a href="index.php?page=membership&idFrameDelete=<?=$row['idMembershipFrame']?>"
					 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang["delete"]?></a></td>
		</tr>
		<?php
		}
		?>
</table>
