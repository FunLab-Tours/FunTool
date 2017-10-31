<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 21/09/2017
 * Time: 15:34
 */
?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['machineName']?></td>
        <td><?=$lang['codeMachineInput']?></td>
        <td><?=$lang['maintenance_name_time']?></td>
    </tr>
    <?php foreach (getMachineList() as $machine){ ?>
        <tr>
            <td><?=$machine['shortLabel']?>{</td>
            <td><?=$machine['codeMachine']?></td>
            <td>
                <?php foreach (listMaintenances($machine['idMachine']) as $maintenance) { ?>
                    <?=$maintenance['nameMaintenance']." ".$lang['each']." ".$maintenance['timeBetweenMaintenances']." ".$lang['remainTime']." ".remainTimeMaintenances(['idMaintenance'])?>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>