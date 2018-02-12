<?php

if(isset($_POST['submit']) && !empty($_POST['submit'])) {
	$errorManager = updateMembership($_POST['membershipDate'], $_POST['endMembershipDate'], $_POST['paymentMethod'], $_POST['adminCommentary'], $_POST['idMembershipFrame'], $_GET['idEditMembership']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=membership&listMembership=0');
	else if($errorManager < 0)
		echo $error[$errorManager];
}

?>

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
			<?php
			if($row['idUser'] == $_GET['idEditMembership']) {
				?>
				<form action="" method="post">
					<label for="membershipDate"></label><input id="membershipDate" type="date" name="membershipDate"
															   value="<?=$row['membershipDate']?>"/>
					<label for="endMembershipDate"></label><input id="endMembershipDate" type="date"
																  name="endMembershipDate"
																  value="<?=$row['endMembershipDate']?>"/>
					<label for="paymentMethod"></label><input id="paymentMethod" type="text"
															  placeholder="<?=$lang["paymentMethod"]?>"
															  name="paymentMethod"
															  value="<?=$row['paymentMethod']?>"/>
					<label for="adminCommentary"></label><input id="adminCommentary" type="text"
																placeholder="<?=$lang["adminCommentary"]?>"
																name="adminCommentary"
																value="<?=$row['adminCommentary']?>"/>
					<label for="select"></label><select id="select" name="idMembershipFrame">
						<option value= <?=$row['idMembershipFrame']?> selected><?=selectMembershipFrame($row['idMembershipFrame'])['frameName']?></option>
						<?php
						$membershipFrameList = (array)listAllMembershipFrame();

						if($membershipFrameList && $membershipFrameList > 0)
							foreach($membershipFrameList as $rowBis) {

								?>
								<option value= <?=$rowBis['idMembershipFrame']?>><?=$rowBis['frameName']?></option>
								<?php
							}
						?>
					</select>
					<label for="submit"></label><input id="submit" type="submit" value="<?=$lang["submit"]?>"
													   name="submit"><a
							href="index.php?page=membership&listMembership"><?=$lang["cancel"]?></a>
				</form>

				<?php
			}
			else {
				?>
				<td><?=$row['membershipDate']?></td>
				<td><?=$row['endMembershipDate']?></td>
				<td><?=$row['paymentMethod']?></td>
				<td><?=$row['adminCommentary']?></td>
				<td><?=selectMembershipFrame($row['idMembershipFrame'])['frameName']?></td>
				</tr>

				<?php
			}
		}
	}
	?>
</table>
