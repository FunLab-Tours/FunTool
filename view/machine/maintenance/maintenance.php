<?php

if(isset($_POST['submit']) || isset($_GET['idDelete'])) {
	if(isset($_GET['idAdd']))
		$errorManager = createMaintenance($_POST['maintenanceName'], $_POST['daysBetweenMaintenance'], $_GET['idAdd']);
	else if(isset($_POST['idEdit']))
		$errorManager = editMaintenance($_POST['idEdit'], $_POST['maintenanceName'], $_POST['daysBetweenMaintenance']);
	else if(isset($_GET['idDelete']))
		$errorManager = deleteMaintenance($_GET['idDelete']);

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
				<input type="number" placeholder="<?=$lang['daysBetweenMaintenanceInput']?>"
					   name="daysBetweenMaintenance"/>
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
					<table>
						<?php foreach(listMaintenance($machine['idMachine']) as $maintenance)
							if(isset($_GET['idEdit']) && $maintenance['idMaintenance'] == $_GET['idEdit']) { ?>
								<tr>
								<td>
									<form method="POST" action="">
										<?=$machine['shortLabel']?>
										<?=$machine['codeMachine']?>
										<input type="text" placeholder="<?=$lang['maintenanceNameInput']?>" name="maintenanceName" value="<?=$maintenance['nameMaintenance']?>"/>
										<input type="number" placeholder="<?=$lang['daysBetweenMaintenanceInput']?>" name="daysBetweenMaintenance" value="<?=$maintenance['daysBetweenMaintenance']?>"/>
										<input type="hidden" name="idEdit" value="<?=$maintenance['idMaintenance']?>">
										<input type="submit" value="<?=$lang["submit"]?>" name="submit"/>
									</form>
								</td>
								<?php
							}
							else {
								?>
								<tr>
									<td><?=$maintenance['nameMaintenance'] . ", " . $lang['each'] . " " . $maintenance['daysBetweenMaintenance'] . " " . $lang['day'] . ". " . $lang['remainTime'] . " : " . remainTimeMaintenance($maintenance['idMaintenance'])?></td>
									<td>
										<a href="index.php?page=machine&maintenance&idEdit=<?=$maintenance['idMaintenance']?>"><?=$lang['edit']?></a> |
										<a href="index.php?page=machine&maintenance&idDelete=<?=$maintenance['idMaintenance']?>" onClick="return confirm(<?="'" . $lang['suppressConfirmation'] . "'"?>)"><?=$lang['delete']?></a>
									</td>
								</tr>
							<?php } ?>
					</table>
				</td>
				<td>
					<a href="index.php?page=machine&maintenance&idAdd=<?=$machine['idMachine']?>"><?=$lang['add']?></a>
				</td>
			</tr>
			<?php
		}
	?>
</table>
