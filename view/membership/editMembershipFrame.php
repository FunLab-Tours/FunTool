<table width='80%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang["frameName"]?></td>
        <td><?=$lang["framePrice"]?></td>
        <td><?=$lang["bonusMembership"]?></td>
        <td><?=$lang["entryDate"]?></td>
    </tr>

    <?php
        foreach(listAllMembershipFrame() as $row){
            if($row['idMembershipFrame'] == $_GET['idFrameEdit']){?>
                <tr>
                    <form action="" method="POST">
                        <td><input type="text" placeholder="<?=$lang["frameName"]?>" name="frameName" value = <?=$row['frameName']?> /></td>
                        <td><input type="number" min="0" placeholder="<?=$lang["framePrice"]?>" name="framePrice" value = <?=$row['framePrice']?> /></td>
                        <td><input type="number" min="0" placeholder="<?=$lang["bonusMembership"]?>" name="bonusMembership" value = <?=$row['bonusMembership']?>/></td>
                        <td><input type="submit" value="<?=$lang["submit"]?>" name="submit"></td>
                        <td><a href="index.php?page=lab"><?=$lang["cancel"]?></a></td>
                </tr>
                    </form> 
    <?php
            }
            else {?>
           <tr>
           <td><?=$row['frameName']?></td>
           <td><?=$row['framePrice']?></td>
           <td><?=$row['bonusMembership']?></td>
           <td><?=$row['entryDate']?></td>
           </tr>
    <?php
            }
        }
    ?>
    </table>
    