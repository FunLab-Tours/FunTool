<?php
include("../include/config.php");
include("../include/lang.php");
include("../include/module.php");
include("../include/db.php");
loadModules("machine/machineSubFamily");
loadModules("machine/machine");

if(isset($_GET['machine']) && $_GET["machine"] && isset($_GET['family']) && $_GET["family"]){

    $idMachine = intval($_GET['machine']);
    $idFamily = intval($_GET['family']);
    $result = getSubFamilyListMachine($idMachine);

    //Ajouter à la liste les sous-familles non sélectionnées
    if(count($result) != 0 && in_array($result[0], getSubFamilyList($idFamily)))
    {
        $ids = array();

        echo "<select multiple name =\"idSubFamily[]\"> <option value=\"\" disabled >".$lang['machineSubFamily']."</option>";
        //Affichage des sous-familles de la machine
        foreach ($result as $row) {
            array_push($ids, $row['idSubFamily']);
            echo "<option value=\"" . $row['idSubFamily'] . "\" selected=\"selected\" >" . $row['labelSubFamily'] . "</option>";
        }
        //Affichage du reste des familles de la machine
        $result = getSubFamilyList(getMachine($idMachine)['idFamily']);

        if($result != false) {
            foreach ($result as $row) {
                if (!in_array($row['idSubFamily'], $ids))
                    echo "<option value=\"" . $row['idSubFamily'] . "\">" . $row['labelSubFamily'] . "</option>";
            }
        }
        echo "</select>";
    }
    else {
        $result = getSubFamilyList($idFamily/*getMachine($idMachine)['idFamily']*/);
        //Affichage de tout les sous-familles de la machine
        echo "<select multiple name =\"idSubFamily[]\"> <option value=\"\" selected=\"selected\">".$lang['machineSubFamily']."</option>";
        foreach($result as $row) {
            echo "<option value=\"" . $row['idSubFamily'] . "\">". $row['labelSubFamily'] . "</option>";
        }
        echo "</select>";
    }
}else{
    echo "Can't get parameters !";
}
?>
