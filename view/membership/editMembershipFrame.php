<?php
    $entryDate = date('Ymd');
    if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    try{
        updateMembershipFrame($_GET['idFrameEdit'], $_POST['bonusMembership'], $entryDate, $_POST['frameName'], $_POST['framePrice'], $_POST['frameComment']);
    }
    catch(Exception $e)
    {
        echo 'Message: ' .$e->getMessage();
    }  
        header('Location: index.php?page=membership&listMembershipFrame=0');
    }
?>

<table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["frameName"]?></td>
        <td><?=$lang["frameComment"]?></td>
        <td><?=$lang["framePrice"]?></td>
        <td><?=$lang["bonusMembership"]?></td>
        <td><?=$lang["entryDate"]?></td>
    </tr>

    <?php
        foreach(listAllMembershipFrame() as $row){
            if($row['idMembershipFrame'] == $_GET['idFrameEdit']){?>
                <tr>
                    <form action="" method="post">
                        <td><input type="text" placeholder="<?=$lang["frameName"]?>" name="frameName" value ="<?=$row['frameName']?>" /></td>
                        <td><input type="text" placeholder="<?=$lang["frameComment"]?>" name="frameComment" value ="<?=$row['frameComment']?>" /></td>
                        <td><input type="number" min="0" placeholder="<?=$lang["framePrice"]?>" name="framePrice" value = <?=$row['framePrice']?> /></td>
                        <td><input type="number" min="0" placeholder="<?=$lang["bonusMembership"]?>" name="bonusMembership" value = <?=$row['bonusMembership']?> /></td>
                        <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td>
                        <td><a href="index.php?page=membership&listMembershipFrame=0"><?=$lang["cancel"]?></a></td>
                </tr>
                    </form> 
    <?php
    echo $row['bonusMembership'];
            }
            else {?>
           <tr>
           <td><?=$row['frameName']?></td>
           <td><?=$row['frameComment']?></td>
           <td><?=$row['framePrice']?></td>
           <td><?=$row['bonusMembership']?></td>
           <td><?=$row['entryDate']?></td>
           </tr>
    <?php
            }
        }
    ?>
    </table>
    