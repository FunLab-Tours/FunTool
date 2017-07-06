<?php
include('functions.php');
?>

<?php
    $labels = getMaterialList();
    while($buffer = $labels->fetch()) {
        ?><?=$buffer['labelMat']?></br><?php
    }
?>
