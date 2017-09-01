<?php
    // loadModules("funnies");
    
    if(isset($_POST['buyFunnies'])){
        include("addFunniesInfoChecked.php");
    }

    else if(isset($_POST['funniesPayment'])){
        include("paymentFunniesAccepted.php");
    }
    else{
        include("addFunnies.php");
    }
?>