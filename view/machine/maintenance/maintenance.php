<?php

if(isset($_POST['submit'])) {
	$errorManager = createMaintenance($_POST['maintenanceName'], $_POST['daysBetweenMaintenance'], $_GET['idAdd']);

	if($errorManager == "" || ($errorManager && $errorManager > 0))
		header('Location: index.php?page=machine&maintenance');
	else
		echo $error[$isValidSignOnReturn];
}

?>

<table width='80%' border=0>
	<tr bgcolor='#CCCCCC'>
		<td><?=$lang['machineName']?></td>
		<td><?=$lang['codeMachineInput']?></td>
		<td><?=$lang['maintenance_name_time']?></td>
	</tr>
	<?php
	foreach(getMachineList() as $machine)
		if(isset($_GET['idAdd']) && $machine['idMachine'] == $_GET['idAdd']) { ?>
			<form method="POST" action="">
				<?=$machine['shortLabel']?>
				<?=$machine['codeMachine']?>
				<input type="text" placeholder="<?=$lang['maintenanceNameInput']?>" name="maintenanceName"/>
				<input type="number" placeholder="<?=$lang['daysBetweenMaintenanceInput']?>" name="daysBetweenMaintenance"/>
				<input type="submit" value="<?=$lang["submit"]?>" name="submit"/>
			</form>
			<?php
		}
		else {
			?>
			<tr>
				<td><?=$machine['shortLabel']?></td>
				<td><?=$machine['codeMachine']?></td>
				<td>
					<?php foreach(listMaintenance($machine['idMachine']) as $maintenance) { ?>
						<?=$maintenance['nameMaintenance'] . ", " . $lang['each'] . " " . $maintenance['daysBetweenMaintenance'] . " " . $lang['day'] . ". " . $lang['remainTime'] . " : " . remainTimeMaintenance($maintenance['idMaintenance'])?>
					<?php } ?>
				</td>
				<td><a href="index.php?page=machine&maintenance&idAdd=<?=$machine['idMachine']?>"><?=$lang['add']?></a>
			</tr>
			<?php
		}
	?>
</table>
