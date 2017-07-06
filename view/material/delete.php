<?php
    include('functions.php');

    if(isset($_POST['submit']))
        deleteMaterial();

?>

<form method="POST" action="">
    <select name="materialList">
        <?php
            $labels = getMaterialList();
            while($buffer = $labels->fetch()) {
                ?><option value="<?=$buffer['idMat']?>"><?=$buffer['labelMat']?></option><?php
            }
        ?>
    </select></br>
    <input type="submit" name="submit" value="submit" />
</form>
