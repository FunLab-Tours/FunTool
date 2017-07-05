<?php
	include('functions.php');

	if(isValidMachineSubmit())
		addMachine();
	else if(strlen(http_build_query($_POST)) != 0)
		echo "Error.";

?>

<form method="POST" action="add.php">
	<input type="text" placeholder="Code machine" name="codeMachine" />								</br>
	<input type="text" placeholder="Short label" name="shortLabel" />								</br>
	<input type="text" placeholder="Long label" name="longLabel" />									</br>
	<input type="number" placeholder="Machine use price" name="machineUsePrice" min="1" max="50">	</br>
	<input type="text" placeholder="Serial number" name="serialNumber" />							</br>
	<input type="text" placeholder="Manufacturer" name="manufacturer" />							</br>
	<input type="text" placeholder="Comment" name="comment" />										</br>
	<input type="text" placeholder="Doc link 1" name="docLink1" />									</br>
	<input type="text" placeholder="Doc link 2" name="docLink2" />									</br>
	<input type="submit" value="submit" />
</form>
