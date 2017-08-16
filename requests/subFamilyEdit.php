<?php
include("../include/config.php");
include("../include/lang.php");
include("../include/module.php");
include("../include/db.php");
loadModules("machineSubFamily");
loadModules("machine");

if(isset($_GET['machine']) && $_GET["machine"] && isset($_GET['family']) && $_GET["family"]){

    $idMachine = intval($_GET['machine']);
    $idFamily = intval($_GET['family']);
    var_dump($idFamily);
    $result = getSubFamilyListMachine($idMachine)->fetchAll();

    //Ajouter à la liste les sous-familles non sélectionnées
    if(count($result) != 0)
    {
        $ids = array();
        echo "<td><select multiple name =\"idsSubFamily[]\"> <option value=\"\" disabled >".$lang['machineSubFamily']."</option>";
        //Affichage des sous-familles de la machine
        foreach ($result as $row) {
            array_push($ids, $row['idSubFamily']);
            echo "<option value=\"" . $row['idSubFamily'] . "\" selected=\"selected\" >" . $row['labelSubFamily'] . "</option>";
        }
        //Affichage du reste des familles de la machine
        $result = getSubFamilyList(getMachine($idMachine)['idFamily']);
        if(count($result) != 0)
            foreach($result as $row) {
                var_dump($row['idSubFamily']);
                if(!in_array($row['idSubFamily'], $ids))
                    echo "<option value=\"" . $row['idSubFamily'] . "\">" . $row['labelSubFamily'] . "</option>";
            }
        echo "</select></td>";
    }
    else {
        $result = getSubFamilyList(getMachine($idMachine)['idFamily']);
        //Affichage de tout les sous-familles de la machine
        echo "<td><select multiple name =\"idsSubFamily[]\"> <option value=\"\" selected=\"selected\">".$lang['machineSubFamily']."</option>";
        foreach($result as $row) {
            echo "<option value=\"" . $row['idSubFamily'] . "\">". $row['labelSubFamily'] . "</option>";
        }
        echo "</select></td>";
    }
}else{
    echo "Can't get parameters !";
}
?>
