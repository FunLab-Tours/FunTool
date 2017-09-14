<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/09/2017
 * Time: 12:57
 */

if(isset($_POST['submit']) && isset($_POST['machine']))
    header('Location: index.php?page=machineUseForm&addUseForm='.$_POST['machine']);
?>

<form action="" method="post" id="form">
    <select name="machine">
        <option disabled selected value=""><?=$lang['chooseMachine']?></option>
        <?php foreach(getMachineList() as $machine) { ?>
            <option value="<?=$machine['idMachine']?>"><?=$machine['shortLabel']?></option>
        <?php } ?>
    </select>
    <input type="submit" name="submit" value="<?=$lang['submit']?>">
</form>

