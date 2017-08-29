<?php
    if(selectPaymentMethodInMembership($_POST['idUser']) !== NULL){
        updateMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
                         $_POST['idMembershipFrame'] ,$_POST['idUser']);

    }

    else{
        addMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
                      $_POST['idMembershipFrame'] ,$_POST['idUser']);

                      
    }
    header('Location: index.php?page=membership');
?>