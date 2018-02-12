<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["family_label"]?></td>
		<td><?=$lang["family_code"]?></td>
		<td><?=$lang["family_nbr_sub"]?></td>
	</tr>

	<?php
	foreach(getFamilyList() as $row) {
		?>
		<tr>
			<td><?=$row['familyLabel']?></td>
			<td><?=$row['familyCode']?></td>
			<td><?=countNbrSubFamily($row['idFamily'])?></td>
			<td>
				<a href="index.php?page=machine&idEditFamily=<?=$row['idFamily']?>"><?=$lang['edit']?></a>
				| <a href="index.php?page=machine&idDeleteFamily=<?=$row['idFamily']?>"
					 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a>
				| <a href="?page=machine&add_subFamily=<?=$row['idFamily']?>"><?=$lang["add_subFamily"]?></a>
			</td>
		</tr>

		<!-- Print family and subfamily under it. -->
		<?php
		foreach(getSubFamilyList($row['idFamily']) as $sub_row) {
			?>
			<tr>
				<td><?=$sub_row['labelSubFamily']?></td>
				<td><?=$sub_row['codeSubFamily']?></td>
				<td><a href="index.php?page=machine&idEditSubFamily=<?=$sub_row['idSubFamily']?>"><?=$lang['edit']?></a>
					| <a href="index.php?page=machine&idDeleteSubFamily=<?=$sub_row['idSubFamily']?>"
						 onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a></td>
			</tr>
			<?php
		}
	}
	?>
</table>

<a href="?page=machine&add_family"><?=$lang["add_family"]?></a>
