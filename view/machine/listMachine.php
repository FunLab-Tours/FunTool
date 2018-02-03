<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["codeMachineInput"]?></td>
            <td><?=$lang["machineShortLabel"]?></td>
            <td><?=$lang["machineLongLabel"]?></td>
            <td><?=$lang["machineSerialNumber"]?></td>
            <td><?=$lang["machineManufacturer"]?></td>
            <td><?=$lang["machineComment"]?></td>
            <td><?=$lang["machineDocLink1"]?></td>
            <td><?=$lang["machineDocLink2"]?></td>
            <td><?=$lang["machineFamily"]?></td>
            <td><?=$lang["machineSubFamily"]?></td>
            <td><?=$lang["fullcost"]?></td>
            <td><?=$lang["idPictureInput"]?></td>
            <td><?=$lang["funLab"]?></td>
            <td><?=$lang["machineMaterials"]?></td>
        </tr>

        <?php
            foreach(getMachineList() as $row) {
        ?>
                <tr>
                    <td><?=$row['codeMachine']?></td>
                    <td><?=$row['shortLabel']?></td>
                    <td><?=$row['longLabel']?></td>
                    <td><?=$row['serialNumber']?></td>
                    <td><?=$row['manufacturer']?></td>
                    <td><?=$row['comment']?></td>
                    <td><?=$row['docLink1']?></td>
                    <td><?=$row['docLink2']?></td>
					<td><?=getFamilyLabel($row['idFamily'])?></td>
                    <td><?php
                        foreach(getSubFamilyListMachine($row['idMachine']) as $subRow)
                            echo $subRow['labelSubFamily']." ; ";
                        ?>
                    </td>
                    <td><?=getCostUnit($row['idCostUnit'])[0]." / ".getCostUnit($row['idCostUnit'])[1]?></td>
                    <?php if(getPicture($row['idPicture']) != null){ ?>
                        <td><img src = "<?=getPicture($row['idPicture'])['picture']?>" alt = "<?=getPicture($row['idPicture'])['pictureDescription']?>"</td>
                    <?php } else { ?> <td></td><?php } ?>
                    <td><?=getLabName($row['idLab'])?></td>
                    <td><?php
                        foreach(getMaterialsMachine($row['idMachine']) as $material)
                            echo $material['labelMat']." ; ";
                        ?>
                    </td>
                    <td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a>
                        | <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
        <?php
            }
        ?>
    </table>
</body>
