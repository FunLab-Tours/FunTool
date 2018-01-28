<?php

    $idMachine = $_GET['addUseForm'];
    $nbrMaterials = sizeof(getMaterialsMachine($idMachine));

    if(isset($_POST['submit'])) {
        $filledFields = true;

        for($count = 0; $count < $nbrMaterials; $count++)
            if(!isset($_POST['material'.$count]))
                $filledFields = false;

        if($filledFields != false && isset($_POST['duration']) && isset($_POST['date'])) {
            $quantityMaterials = array();
            $count = 0;

            foreach(getMaterialsMachine($idMachine) as $material) {
                array_push($quantityMaterials, array('idMaterial' => $material['idMat'], 'quantity' => $_POST['material'.$count]));
                $count++;
            }

            $costAndId = createMachineUseForm($_COOKIE['id'], $idMachine, $_POST['date'], $_POST['duration'], $_POST['comment'], $quantityMaterials, $lang['unpaid']);

            $count = 0;
            foreach(getMaterialsMachine($idMachine) as $material) {
                updateMaterialsQuantity(listAllLab()[0]['idLab'], $material['idMat'], intval($_POST['material'.$count]) * (-1));
                $count++;
            }

            header('Location: index.php?page=machineUseForm&confirmation='.$costAndId['cost'].'&useForm='.$costAndId['id']);
        }
    }

?>

<form action="" method="POST">

    <?=$lang['usedDate']?> : <input type="datetime-local" name="date">
    <?=$lang['usedTime']?> : <input type="time" name="duration">
    <div></div>
    <?php $countMaterials = 0;
    foreach (getMaterialsMachine($idMachine) as $material) { ?>
        <?=$material['labelMat']?>
        <input type="number" value=0 placeholder=0 name="material<?=$countMaterials?>">
        <?=getCostUnitMat($material['idMat'])['unit']?>
        <div></div>
    <?php $countMaterials++;
    } ?>
    <input placeholder="<?=$lang['comment']?>" value="" name="comment">
    <input type="submit" value="<?=$lang['submit']?>" name="submit">

</form>