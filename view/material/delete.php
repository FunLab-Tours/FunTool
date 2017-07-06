<?php
include('functions.php');

if(strlen(http_build_query($_POST)) != 0)
    deleteMaterial();

?>

<form method="POST" action="delete.php">
    <select name="materialList">
        <?php
            $labels = getMaterialList();
            while($buffer = $labels->fetch()) {
                ?><option value="<?=$buffer['idMat']?>"><?=$buffer['labelMat']?></option><?php
            }
        ?>
    </select></br>
    <input type="submit" value="submit" />
</form>
