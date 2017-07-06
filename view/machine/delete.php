<?php
	include('functions.php');

	if(strlen(http_build_query($_POST)) != 0)
		deleteMachine();

?>

<form method="POST" action="delete.php">
	<select name="machineList">
		<?php 
			$labels = getMachineList();
			while($buffer = $labels->fetch()) {
				?><option value="<?=$buffer['idMachine']?>"><?=$buffer['codeMachine']?></option><?php
			}
		?>
	</select></br>
	<input type="submit" value="submit" />
</form>
