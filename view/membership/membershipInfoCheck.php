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
<br></br>
<?php  
    $totalToPay = $donationRadio + $donation + $membershipPrice;
    echo $lang["total"]." ".$totalToPay." €";
?>

<!-- <form action="" method="POST">
    <input type="hidden" value="<?=$membershipingDate ?>" name="membershipingDate">
    <input type="hidden" value="<?=$endMembershipDate ?>" name="endMembershipDate">
    <input type="hidden" value="<?=$idMembershipFrame?>" name="idMembershipFrame">
    <input type="hidden" value="<?=$idUser?>" name="idUser">
    <input type="hidden" value="<?=$bonusMembership?>" name="bonusMembership">
    <input type="submit" value="<?=$lang["submit"]?>" name="membershipPayed">
</form> -->





<!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="baudry.guill@gmail.com">
<input type="hidden" name="lc" value="FR">
<input type="hidden" name="amount" value="<?=$totalToPay?>">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="cn" value="Add special instructions to the seller:">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<input type="image" src="https://www.sandbox.paypal.com/en_US/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form> -->




<div id="paypal-button-container"></div>

    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AVhI4MBFx-KY4qC5pba4Ud1GNzZhkE3UivYAJ92nitSQ9MscxAHPYCJRAfOXIIK85sGZk3GcfT3D0Tdz',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: <?=$totalToPay?>, currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                    location.replace("index.php?page=membership&idUser=<?=$idUser?>&membershipingDate=<?=$membershipingDate?>&endMembershipDate=<?=$endMembershipDate?>&idMembershipFrame=<?=$idMembershipFrame?>&bonusMembership=<?=$bonusMembership?>");
                    // document.getElementById("paymentAccepted").innerHTML = 
                    // var div = document.getElementById("dom-target");
                    // var myData = div.textContent;


                });
            
            }

        }, '#paypal-button-container');





    </script>

<div id="dom-target" style="display: none;">
    <?php  
        // if(selectMembership($idUser)['endMembershipDate'] !== NULL){
        //     updateMembership($membershipingDate,$endMembershipDate,'web','',
        //                         $idMembershipFrame ,$idUser);
        //     addFunnies($idUser,$bonusMembership);
                                
    
        // }
    
        // else{
        //     addMembership($membershipingDate,$endMembershipDate,'web','',
        //                     $idMembershipFrame ,$idUser);
        //     addFunnies($idUser,$bonusMembership);
                            
                            
        // }
        // header('Location: index.php?page=membership');
    ?>;
</div>
<div id="paymentAccepted"></div>