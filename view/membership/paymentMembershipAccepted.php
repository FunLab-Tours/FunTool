<?php
    addMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',$_POST['idMembershipFrame'] ,$_POST['idUser']);
    echo selectEndMembershipDate($_POST['idUser'])[0]['endMembershipDate'];
?>