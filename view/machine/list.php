<?php
	include('functions.php');
?>

<?php 
	$labels = getMachineList();
	while($buffer = $labels->fetch()) {
		?><?=$buffer['codeMachine']?></br><?php
	}
?>
