<?php

$entryDate = date('Ymd');

if(isset($_POST['submit']) && !empty($_POST['submit'])) {
	$errorManager = updateMembershipFrame($_GET['idFrameEdit'], $_POST['bonusMembership'], $entryDate, $_POST['frameName'], $_POST['framePrice'], $_POST['frameComment']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=membership&listMembershipFrame');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang["frameName"]?></td>
		<td><?=$lang["frameComment"]?></td>
		<td><?=$lang["framePrice"]?></td>
		<td><?=$lang["bonusMembership"]?></td>
		<td><?=$lang["entryDate"]?></td>
	</tr>

	<?php
	$membershipFrameList = (array)listAllMembershipFrame();

	if($membershipFrameList && $membershipFrameList > 0)
		foreach($membershipFrameList as $row) {
			if($row['idMembershipFrame'] == $_GET['idFrameEdit']) {
				?>
					<form action="" method="post">
						<input type="text" placeholder="<?=$lang["frameName"]?>" name="frameName" value="<?=$row['frameName']?>"/>
						<input type="text" placeholder="<?=$lang["frameComment"]?>" name="frameComment" value="<?=$row['frameComment']?>"/>
						<input type="number" min="0" placeholder="<?=$lang["framePrice"]?>" name="framePrice" value="<?=$row['framePrice']?>"/>
						<input type="number" min="0" placeholder="<?=$lang["bonusMembership"]?>" name="bonusMembership" value="<?=$row['bonusMembership']?>"/>
						<input type="submit" value="<?=$lang["submit"]?>" name="submit">
						<a href="index.php?page=membership&listMembershipFrame"><?=$lang["cancel"]?></a>
					</form>
				<?php
			}
			else { ?>
				<tr>
					<td><?=$row['frameName']?></td>
					<td><?=$row['frameComment']?></td>
					<td><?=$row['framePrice']?></td>
					<td><?=$row['bonusMembership']?></td>
					<td><?=$row['entryDate']?></td>
				</tr>
				<?php
			}
		}
	?>
</table>
    