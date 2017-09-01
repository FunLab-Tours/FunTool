<?php
    $valueDiffDate = compareTwoDates(date('Y-m-d'),date((returnValidDateForMembership($_COOKIE["id"]))));
    if ($valueDiffDate<32){
        if($valueDiffDate>0){
?>
<br></br>
<?php
            echo $lang["rest"]." ".$valueDiffDate." ".$lang["daysOfMembership"];
?>
<br></br>
<?php
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
    <input type="hidden" value="<?=$valueDiffDate?>" name="valueDiffDate">
    <input type="submit" value="<?=$lang["submit"]?>" name="submitMembership"> 
</form>

<?php
    }
    else{
?>
<br></br>
<?php       
        echo $lang["rest"]." ". $valueDiffDate ." ".$lang["daysOfMembership"];
    }
?>