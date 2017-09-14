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
        try{
        updateMembership($_GET['membershipingDate'],$_GET['endMembershipDate'],'web','',
                         $_GET['idMembershipFrame'] ,$_GET['idUser']);
        addFunnies($_GET['idUser'],$_GET['bonusMembership']);
        }
        catch(Exception $e)
        {
            echo 'Message: ' .$e->getMessage();
        }  
                         
    }

    else{
        try{
        addMembership($_GET['membershipingDate'],$_GET['endMembershipDate'],'web','',
                      $_GET['idMembershipFrame'] ,$_GET['idUser']);             
        addFunnies($_GET['idUser'],$_GET['bonusMembership']);
        }
        catch(Exception $e)
        {
            echo 'Message: ' .$e->getMessage();
        }         
                              
    }
        header('Location: index.php?page=membership');
?>