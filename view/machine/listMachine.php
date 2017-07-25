<body>
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td><?=$lang["machineName"]?></td>
            <td><?=$lang["machineShortLabel"]?></td>
            <td><?=$lang["machineLongLabel"]?></td>
            <td><?=$lang["machineUsePrice"]?></td>
            <td><?=$lang["machineSerialNumber"]?></td>
            <td><?=$lang["machineManufacturer"]?></td>
            <td><?=$lang["machineComment"]?></td>
            <td><?=$lang["machineDocLink1"]?></td>
            <td><?=$lang["machineDocLink2"]?></td>
        </tr>

        <?php
            foreach(getMachineList() as $row) {
        ?>
                <tr>
                    <td><?=$row['codeMachine']?></td>
                    <td><?=$row['shortLabel']?></td>
                    <td><?=$row['longLabel']?></td>
                    <td><?=$row['machineUsePrice']?></td>
                    <td><?=$row['serialNumber']?></td>
                    <td><?=$row['manufacturer']?></td>
                    <td><?=$row['comment']?></td>
                    <td><?=$row['docLink1']?></td>
                    <td><?=$row['docLink2']?></td>
                    <td><a href="index.php?page=machine&idEdit=<?=$row['idMachine']?>"><?=$lang['edit']?></a> | <a href="index.php?page=machine&idDelete=<?=$row['idMachine']?>" onClick="return confirm('Are you sure you want to delete?')"><?=$lang['delete']?></a></td>
        <?php
            }
        ?>
    </table>
</body>
