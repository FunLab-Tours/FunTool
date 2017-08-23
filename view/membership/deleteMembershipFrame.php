<?php
    deleteMembershipFrame($_GET['idFrameDelete']);
    header('Location: index.php?page=membership&listMembershipFrame=0');

?>