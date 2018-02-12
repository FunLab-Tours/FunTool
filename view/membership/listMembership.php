<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["login"]?></td>
		<td><?=$lang["firstName"]?></td>
		<td><?=$lang["name"]?></td>
		<td><?=$lang["email"]?></td>
		<td><?=$lang["membershipDate"]?></td>
		<td><?=$lang["endDateMembershipDate"]?></td>
		<td><?=$lang["paymentMethod"]?></td>
		<td><?=$lang["adminCommentary"]?></td>
		<td><?=$lang["frameName"]?></td>
	</tr>

	<?php
	foreach(listAllMembership() as $row) {
		if(compareTwoDates(date('Y-m-d'), date(selectMembership($row['idUser'])['endMembershipDate'])) >= 0) {
			?>
			<tr>
				<td><?=getUser($row['idUser'])['login']?></td>
				<td><?=getUser($row['idUser'])['firstName']?></td>
				<td><?=getUser($row['idUser'])['name']?></td>
				<td><?=getUser($row['idUser'])['email']?></td>
				<td><?=$row['membershipDate']?></td>
				<td><?=$row['endMembershipDate']?></td>
				<td><?=$row['paymentMethod']?></td>
				<td><?=$row['adminCommentary']?></td>
				<td><?=selectMembershipFrame($row['idMembershipFrame'])['frameName']?></td>
				<td><a href="index.php?page=membership&idEditMembership=<?=$row['idUser']?>"><?=$lang["edit"]?></a> | <a
							href="index.php?page=membership&idDeleteMembership=<?=$row['idUser']?>"
							onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
			</tr>

			<?php
		}
	}
	?>
</table>