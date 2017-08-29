<?php
    echo $lang["goingToBuy"]." ".$_POST['nbFunnies']." Funnies";
?>
<br></br>
<?php
    $newBalance = $_POST['nbFunnies']+currentUserFunnies($_COOKIE['id']);
    echo $lang["newBalance"]." ".$newBalance." Funnies";
?>
<form action="" method="POST">
    <input type="hidden" value="<?=$newBalance?>" name="newBalance">
    <input type="submit" value="<?=$lang["submit"]?>" name="funniesPayment"> 
</form>