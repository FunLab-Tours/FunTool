<?php

    $cost = $_GET['confirmation'];
    $idUseForm = $_GET['useForm'];
    $currentFunnies = currentUserFunnies($_COOKIE['id']);

    $enough = true;
    if($currentFunnies - $cost < 0)
        $enough = false;

    if($enough == true) {
        updateUserFunnies($_COOKIE['id'], $currentFunnies - $cost);
        echo $lang['transactionDone'].$cost.$lang['funnies'];
        setTransactionStatus($idUseForm, $lang['paid']);
    }
    else{
        echo $lang['notEnoughFunnies'];
        echo "<a href=\"?page=funnies\">".$lang["buyFunnies"]."</a>";
    }

?>