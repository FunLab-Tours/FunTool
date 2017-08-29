<?php
    $membershipingDate = date('Ymd');
    if($_POST['valueDiffDate']>0 && $_POST['valueDiffDate']<32){
        $endMembershipDate = date('ymd', strtotime('+1 year', strtotime(returnValidDateForMembership($_COOKIE["id"]))));
    }
    else{
        $endMembershipDate = date('Ymd', strtotime('+1 year'));
    }
    $membershipPrice = selectMembershipFrame($_POST['framePrice'])[0]['framePrice'];
    $frameName = selectMembershipFrame($_POST['framePrice'])[0]['frameName'];
    $idMembershipFrame = selectMembershipFrame($_POST['framePrice'])[0]['idMembershipFrame'];
    $idUser = $_COOKIE["id"];
?>
<br></br>

<?php
    echo $lang["selectedFrame"]." ".$frameName." ".$lang["for"]." ".$membershipPrice." €";
    $donationRadio = $_POST['donationRadio']; 
    $donation = $_POST['donation'];
?>
<br></br>
<?php
    if($donationRadio>0){
        echo $lang["donationGiven"]." ".$donationRadio." €";
    }
    else if($donation>0){
        echo $lang["donationGiven"]." ".$donation." €";
    }       
?>
<form action="" method="POST">
    <input type="hidden" value="<?=$membershipingDate ?>" name="membershipingDate">
    <input type="hidden" value="<?=$endMembershipDate ?>" name="endMembershipDate">
    <input type="hidden" value="<?=$idMembershipFrame?>" name="idMembershipFrame">
    <input type="hidden" value="<?=$idUser?>" name="idUser">
    <input type="submit" value="<?=$lang["submit"]?>" name="membershipPayed">
</form>
