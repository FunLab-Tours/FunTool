<?php
    if(isset($_POST['submit'])){
            addEvent($_POST['shortSumEvent'], $_POST['longSumEvent'], $_POST['startdateEvent'], $_POST['endDatEvent'], $_POST['statutEvent'], $_POST['nbPlaces'], $_POST['pricePlace']);
            header('Location: index.php?page=event');

        }

?>

 <form action="" method="POST">
    <input type="text" placeholder="<?=$lang["shortSumEvent"]?>" name="shortSumEvent" />
     <br><br>
    <textarea rows="5" cols="50" placeholder="<?=$lang["longSumEvent"]?>" name="longSumEvent"></textarea>
    <br><br> 
    <input type="datetime-local" placeholder="<?=$lang["startdateEvent"]?>" name="startdateEvent" />
     : <?=$lang["startdateEvent"]?>
    <br><br>
    <input type="datetime-local" placeholder="<?=$lang["endDatEvent"]?>" name="endDatEvent" />
     : <?=$lang["endDatEvent"]?>
    <br><br>
    <select name="statutEvent">
        <option value="ok"><?=$lang["statutOk"]?></option>
        <option value="maybe"><?=$lang["statutMaybe"]?></option>
        <option value="cancel"><?=$lang["statutCancel"]?></option>
    </select>
    : Statut
     <br><br>
    <input type="number" min="0" placeholder="<?=$lang["nbPlaces"]?>" name="nbPlaces" />
    <br><br>
    <input type="number" min="0" placeholder="<?=$lang["pricePlace"]?>" name="pricePlace" />
    <br><br> 
    <input type="submit" value="<?=$lang["submit"]?>" name="submit"> 
</form> 
