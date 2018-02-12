<?php

// TODO : check valueDiffDate.

$errorManager = $valueDiffDate = compareTwoDates(date('Y-m-d'), date((returnValidDateForMembership($_COOKIE["id"]))));

if($errorManager == "" || ($errorManager && $errorManager > 0))
	if($valueDiffDate < 32) {
		if($valueDiffDate > 0) {
			?>
			<br/>
			<?=$lang['rest'] . " " . $valueDiffDate . " " . $lang['daysOfMembership']?>
			<br/>
			<?php
		}
		?>

		<form action="" method="POST">
			<table>
				<?php
				$membershipFrameList = (array)listAllMembershipFrame();

				if($membershipFrameList && $membershipFrameList > 0)
					foreach($membershipFrameList as $row) {

						?>
						<label for="<?=$row['frameName']?>">
							<?=$row['frameName']?><br/>
							<?=$row['frameComment']?><br/>
							<?=$row['framePrice']?>€<br/>
						</label>
						<input id="<?=$row['frameName']?>" type="radio" name="framePrice" value="<?=$row['idMembershipFrame']?>"><br/>
						<?php
					}
				?>
			</table>

			<br/>
			<?=$lang["donationRequest"]?>
			<br/>

			<label for="no"><?=$lang["noDonation"]?></label><input id="no" type="radio" name="donationRadio" value="0" checked>
			<label for="20">20€</label><input id="20" type="radio" name="donationRadio" value="20">
			<label for="50">50€</label><input id="50" type="radio" name="donationRadio" value="50">
			<label for="150">150€</label><input id="150" type="radio" name="donationRadio" value="150">
			<br/>
			<label for="free"><?=$lang["freeDonation"]?></label><input id="free" type="radio" name="donationRadio" value="0">
			<input type="number" min="0" placeholder="<?=$lang["valueFreeDonation"]?>" name="donation"/>
			<br/>
			<input type="hidden" value="<?=$valueDiffDate?>" name="valueDiffDate">
			<input type="submit" value="<?=$lang["submit"]?>" name="submitMembership">
		</form>

		<?php
	}
	else {
		?>
		<br/>
		<?=$lang['rest'] . " " . $valueDiffDate . " " . $lang['daysOfMembership']?>
		<?php
	}
else
	echo $error[$errorManager];
