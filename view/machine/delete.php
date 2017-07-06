<?php
	include('functions.php');

    if(isset($_POST['submit']))
		deleteMachine();

?>

<form method="POST" action="">
	<select name="machineList">
		<?php 
			$labels = getMachineList();
			while($buffer = $labels->fetch()) {
				?><option value="<?=$buffer['idMachine']?>"><?=$buffer['codeMachine']?></option><?php
			}
		?>
	</select></br>
	<input type="submit" name="submit" value="submit" />
</form>
