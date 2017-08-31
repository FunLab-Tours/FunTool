<?php
    deleteMembership($_GET['idDeleteMembership']);
    header('Location: index.php?page=membership&listMembership=0');

?>