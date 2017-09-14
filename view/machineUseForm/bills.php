<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 07/09/2017
 * Time: 13:01
 */

?>

<table width='80%' border=0>
    <tr bgcolor='#CCCCCC'>
        <td><?=$lang['bills_dateUseForm']?></td>
        <td><?=$lang['bills_entryDate']?></td>
        <td><?=$lang['bills_machine']?></td>
        <td><?=$lang['bills_duration']?></td>
        <td><?=$lang['bills_materials']?></td>
        <td><?=$lang['comment']?></td>
        <td><?=$lang['bills_totalCost']?></td>
        <td><?=$lang['bills_transactionStatus']?></td>
    </tr>
    <?php foreach(listMachineUseFormUser($_COOKIE['id']) as $machineUseForm){ ?>
        <tr>
            <td><?=$machineUseForm['dateUseForm']?></td>
            <td><?=$machineUseForm['entryDate']?></td>
            <td><?=getMachine($machineUseForm['idMachine'])['shortLabel']?></td>
            <td><?=$machineUseForm['duration']?></td>
            <td>
                <?php foreach (listUsedQuantity($machineUseForm['idUseForm']) as $used) { ?>
                    <?=getMaterial($used['idMat'])['labelMat']?> :
                    <?=$used['quantity']?><?=getCostUnitMat($used['idMat'])['unit']?>
                    ;<br>
                <?php } ?>
            </td>
            <td><?=$machineUseForm['comment']?></td>
            <td><?=calculCost($machineUseForm['idUseForm'])?> <?=$lang['funnies']?></td>
            <td><?=$machineUseForm['TransactionStatut']?></td>
            <?php if(!strcmp($machineUseForm['TransactionStatut'], $lang['unpaid'])){ ?>
                <td>
                    <a href="index.php?page=machineUseForm&confirmation=<?=calculCost($machineUseForm['idUseForm'])?>&useForm=<?=$machineUseForm['idUseForm']?>"><?=$lang['pay']?></a>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>