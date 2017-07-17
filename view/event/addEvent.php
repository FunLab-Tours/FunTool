<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
            addEvent($_POST['shortSumEvent'], $_POST['longSumEvent'], $_POST['startdateEvent'], $_POST['endDatEvent'], $_POST['statutEvent'], $_POST['nbPlaces'], $_POST['pricePlace']);
            header('Location: index.php?page=event');
        }
    
?>

<form action="" id="eventForm" method="post">
    <input type="text" placeholder="<?=$lang["shortSumEvent"]?>" name="shortSumEvent" /></br>
    <textarea rows="4" cols="50" name="longSumEvent" form="eventForm"><?=$lang["longSumEvent"]?></textarea></br>
    <input type="datetime-local" placeholder="<?=$lang["startdateEvent"]?>" name="startdateEvent" /></br>
    <input type="datetime-local" placeholder="<?=$lang["endDatEvent"]?>" name="endDatEvent" /></br>
    <input type="text" placeholder="<?=$lang["statutEvent"]?>" name="statutEvent" />
    <select name="statutEvent">
        <option value="ok"><?=$lang["statutOk"]?>"</option>
        <option value="maybe"><?=$lang["statutMaybe"]?>"</option>
        <option value="cancel"><?=$lang["statutCancel"]?>"</option>
    </select></br>
    <input type="number" placeholder="<?=$lang["nbPlaces"]?>" name="nbPlaces" /></br>
    <input type="number" placeholder="<?=$lang["pricePlace"]?>" name="pricePlace" /></br>
    <input type="submit" value="submit" name="submit">
</form>
