<?php
    $membershipPrice = selectMembershipFrame($_POST['framePrice'])[0]['framePrice'];
    $frameName = selectMembershipFrame($_POST['framePrice'])[0]['frameName'];
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
