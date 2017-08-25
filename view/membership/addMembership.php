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

    <input type ="radio" name ="donation" value=0 checked><?=$lang["noDonation"]?>
    <input type ="radio" name ="donation" value=20>20€
    <input type ="radio" name ="donation" value=50>50€
    <input type ="radio" name ="donation" value=150>150€
    <br></br>
    <input type ="radio" name ="donation" value=0><?=$lang["freeDonation"]?>
    <input type="number" min="0" placeholder="<?=$lang["valueFreeDonation"]?>" name="donation" />
    <br></br>
    <input type="submit" value="<?=$lang["submit"]?>" name="submitMembership"> 
    </form>

