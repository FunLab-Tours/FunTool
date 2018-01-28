<?php
    include("../include/config.php");
    include("../include/lang.php");
    include("../include/module.php");
    include("../include/db.php");

    loadModules("machine/machineSubFamily");
    loadModules("machine/machine");

    if(isset($_GET['machine']) && $_GET["machine"] && isset($_GET['family']) && $_GET["family"]) {
        $idMachine = intval($_GET['machine']);
        $idFamily = intval($_GET['family']);
        $result = getSubFamilyListMachine($idMachine);

        // Add to unselected sub-family list.
        if(count($result) != 0 && in_array($result[0], getSubFamilyList($idFamily))) {
            $ids = array();

            echo "<select multiple name =\"idSubFamily[]\"> <option value=\"\" disabled >".$lang['machineSubFamily']."</option>";

            // Print sub-families of the machine.
            foreach ($result as $row) {
                array_push($ids, $row['idSubFamily']);
                echo "<option value=\"" . $row['idSubFamily'] . "\" selected=\"selected\" >" . $row['labelSubFamily'] . "</option>";
            }

            // Print all other sub-familis of the machine.
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

            // Print all sub-families of the machine.
            echo "<select multiple name =\"idSubFamily[]\"> <option value=\"\" selected=\"selected\">".$lang['machineSubFamily']."</option>";

            foreach($result as $row) {
                echo "<option value=\"" . $row['idSubFamily'] . "\">". $row['labelSubFamily'] . "</option>";
            }

            echo "</select>";
        }
    }
    else
        echo "Can't get parameters !";

?>
