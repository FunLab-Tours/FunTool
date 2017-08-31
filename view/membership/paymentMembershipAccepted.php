<?php
    if(selectMembership($_POST['idUser'])['endMembershipDate'] !== NULL){
        updateMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
                         $_POST['idMembershipFrame'] ,$_POST['idUser']);
        addFunnies($_POST['idUser'],$_POST['bonusMembership']);
                         

    }

    else{
        addMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
                      $_POST['idMembershipFrame'] ,$_POST['idUser']);
        addFunnies($_POST['idUser'],$_POST['bonusMembership']);
                        
                      
    }
    header('Location: index.php?page=membership');
?>