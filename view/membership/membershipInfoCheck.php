<?php
//Vérification si l'utilisateur a encore une adhésion en cours et combien de temps il reste
    $membershipingDate = date('Ymd');
    if($_POST['valueDiffDate']>0 && $_POST['valueDiffDate']<32){
        $endMembershipDate = date('ymd', strtotime('+1 year', strtotime(returnValidDateForMembership($_COOKIE["id"]))));
    }
    else{
        $endMembershipDate = date('Ymd', strtotime('+1 year'));
    }
    $membershipPrice = selectMembershipFrame($_POST['framePrice'])['framePrice'];
    $frameName = selectMembershipFrame($_POST['framePrice'])['frameName'];
    $idMembershipFrame = selectMembershipFrame($_POST['framePrice'])['idMembershipFrame'];
    $idUser = $_COOKIE["id"];
    $bonusMembership = selectMembershipFrame($_POST['framePrice'])['bonusMembership'];
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
    <input type="hidden" value="<?=$bonusMembership?>" name="bonusMembership">
    <input type="submit" value="<?=$lang["submit"]?>" name="membershipPayed">
</form>
