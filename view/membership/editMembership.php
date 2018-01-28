<?php
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
        try {
            updateMembership($_POST['membershipingDate'], $_POST['endMembershipDate'], $_POST['paymentMethod'],
            $_POST['adminCommentary'], $_POST['idMembershipFrame'], $_GET['idEditMembership']);
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

        header('Location: index.php?page=membership&listMembership=0');
    }

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["login"]?></td>
        <td><?=$lang["firstName"]?></td>
        <td><?=$lang["name"]?></td>
        <td><?=$lang["email"]?></td>
        <td><?=$lang["membershipingDate"]?></td>
        <td><?=$lang["endDateMembershipDate"]?></td>
        <td><?=$lang["paymentMethod"]?></td>
        <td><?=$lang["adminCommentary"]?></td>
        <td><?=$lang["frameName"]?></td>
    </tr>
<?php
    foreach(listAllMembership()as$row){
        if(compareTwoDates(date('Y-m-d'),date(selectMembership($row['idUser'])['endMembershipDate']))>=0){    
?>

    <tr>
        <td><?=getUser($row['idUser'])['login']?></td>
        <td><?=getUser($row['idUser'])['firstName']?></td>
        <td><?=getUser($row['idUser'])['name']?></td>
        <td><?=getUser($row['idUser'])['email']?></td>
<?php
            if($row['idUser'] == $_GET['idEditMembership']){
?>  
        <form action="" method="post">
            <td><input type="date" name="membershipingDate" value ="<?=$row['membershipingDate']?>" /></td>
            <td><input type="date" name="endMembershipDate" value ="<?=$row['endMembershipDate']?>" /></td>
            <td><input type="text" placeholder="<?=$lang["paymentMethod"]?>" name="paymentMethod" value ="<?=$row['paymentMethod']?>" /></td>
            <td><input type="text" placeholder="<?=$lang["adminCommentary"]?>" name="adminCommentary" value ="<?=$row['adminCommentary']?>" /></td>
            <td><select name="idMembershipFrame">
                    <option value = <?=$row['idMembershipFrame']?> selected><?=selectMembershipFrame($row['idMembershipFrame'])['frameName']?></option>
<?php
                foreach(listAllMembershipFrame() as $rowBis){
?>
                    <option value = <?=$rowBis['idMembershipFrame']?>><?=$rowBis['frameName']?></option>
<?php
                }
?>               
            </td></select>
            <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"><a href="index.php?page=membership&listMembership=0"><?=$lang["cancel"]?></a> </td>           
        </form>

<?php
            }
            else{
?>
        <td><?=$row['membershipingDate']?></td>
        <td><?=$row['endMembershipDate']?></td>
        <td><?=$row['paymentMethod']?></td>
        <td><?=$row['adminCommentary']?></td>
        <td><?=selectMembershipFrame($row['idMembershipFrame'])['frameName']?></td>
    </tr>

<?php
            }
        }
    }
?>
</table>