<?php

echo $lang["goingToBuy"] . " " . $_POST['nbFunnies'] . " " . $lang['funnies'];

?>

<br/>

<?php

$newBalance = $_POST['nbFunnies'] + currentUserFunnies($_COOKIE['id']);
echo $lang["newBalance"] . " " . $newBalance . " " . $lang['funnies'];

?>

<form action="" method="POST">
	<input type="hidden" value="<?=$newBalance?>" name="newBalance">
	<input type="submit" value="<?=$lang["submit"]?>" name="funniesPayment">
</form>
