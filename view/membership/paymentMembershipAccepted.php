<?php
    // if(selectMembership($_POST['idUser'])['endMembershipDate'] !== NULL){
    //     updateMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
    //                      $_POST['idMembershipFrame'] ,$_POST['idUser']);
    //     addFunnies($_POST['idUser'],$_POST['bonusMembership']);
                         

    // }

    // else{
    //     addMembership($_POST['membershipingDate'],$_POST['endMembershipDate'],'web','',
    //                   $_POST['idMembershipFrame'] ,$_POST['idUser']);
    //     addFunnies($_POST['idUser'],$_POST['bonusMembership']);
                        
                      
    // }
    // header('Location: index.php?page=membership');
?>

<?php
    if(selectMembership($_GET['idUser'])['endMembershipDate'] !== NULL){
        updateMembership($_GET['membershipingDate'],$_GET['endMembershipDate'],'web','',
                         $_GET['idMembershipFrame'] ,$_GET['idUser']);
        addFunnies($_GET['idUser'],$_GET['bonusMembership']);
                         
    }

    else{
        addMembership($_GET['membershipingDate'],$_GET['endMembershipDate'],'web','',
                      $_GET['idMembershipFrame'] ,$_GET['idUser']);             
        addFunnies($_GET['idUser'],$_GET['bonusMembership']);
                              
    }
        header('Location: index.php?page=membership');
?>