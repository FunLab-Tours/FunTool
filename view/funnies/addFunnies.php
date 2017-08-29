<?php
echo $lang["youHave"]." ".currentUserFunnies($_COOKIE['id'])." Funnies";
?>

<form action="" method="POST">
<input type="number" min="0" placeholder="<?=$lang["nbFunnies"]?>" name="nbFunnies" />
<input type="submit" value="<?=$lang["submit"]?>" name="buyFunnies">
</form>