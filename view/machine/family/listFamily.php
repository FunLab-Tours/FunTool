<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["family_label"]?></td>
		<td><?=$lang["family_code"]?></td>
	</tr>

	<?php
	foreach(getFamilyList() as $row) {
		?>
		<tr>
			<td><?=$row['familyLabel']?></td>
			<td><?=$row['familyCode']?></td>
			<td>
				<a href="index.php?page=machine&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a>
				| <a href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>"
					 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a>
			</td>
		</tr>
    <?php
	}
	?>
</table>

<a href="?page=machine&add_family"><?=$lang["add_family"]?></a>
