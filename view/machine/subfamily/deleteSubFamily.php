<?php
    deleteSubFamily($_GET['idDeleteSubFamily']);
    header('Location: index.php?page=machine&familyManagement=0');

?>
