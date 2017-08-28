<?php
    // $currentDate = date_create(date('Y-m-d'));
    // $selectEndMembershipDate = date_create(date((selectEndMembershipDate($_COOKIE["id"])[0]['endMembershipDate'])));
    // $diffDate = date_diff($currentDate,$selectEndMembershipDate);
    // $valueDiffDate = $diffDate->format("%R%a");
    $valueDiffDate = compareTwoDates(date('Y-m-d'),date((selectEndMembershipDate($_COOKIE["id"])[0]['endMembershipDate'])));
    echo $valueDiffDate;
    if ($valueDiffDate<32){
        if($valueDiffDate>0){
            $lang["rest"]." ".$valueDiffDate." ".$lang["daysOfMembership"];
        }
?>
<form action="" method="POST">
    <table>

        <?php
            foreach (listAllMembershipFrame() as $row) {
        ?> 
                <tr>
                    <td><?=$row['frameName']?><br><?=$row['frameComment']?></br></td>
                    <td><?=$row['framePrice']?> €</td>
                    <td><input type ="radio" name ="framePrice" value="<?=$row['idMembershipFrame']?>"></td>
            
                </tr>
        <?php
            }
        ?> 
    </table>

    <br></br>
    <?=$lang["donationRequest"]?>
    <br></br>

    <input type ="radio" name ="donationRadio" value="0" checked><?=$lang["noDonation"]?>
    <input type ="radio" name ="donationRadio" value="20">20€
    <input type ="radio" name ="donationRadio" value="50">50€
    <input type ="radio" name ="donationRadio" value="150">150€
    <br></br>
    <input type ="radio" name ="donationRadio" value="0"><?=$lang["freeDonation"]?>
    <input type="number" min="0" placeholder="<?=$lang["valueFreeDonation"]?>" name="donation" />
    <br></br>
    <input type="submit" value="<?=$lang["submit"]?>" name="submitMembership"> 
</form>

<?php
    }
    else{
        $lang["rest"]." ".$valueDiffDate." ".$lang["daysOfMembership"];
    }
?>