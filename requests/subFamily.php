<?php
    include("../include/config.php");
    include("../include/lang.php");
    include("../include/module.php");
    include("../include/db.php");

    loadModules("machine/machineSubFamily");

    if(isset($_GET['q']) && $_GET["q"]) {

        $idFamily = intval($_GET['q']);
        $result = getSubFamilyList($idFamily);

        echo "<select multiple name =\"idSubFamily[]\"> <option value=\"\" disabled selected=\"selected\">".$lang['machineSubFamily']."</option>";
        foreach($result as $row) {
            echo "<option value=\"" . $row['idSubFamily'] . "\">". $row['labelSubFamily'] . "</option>";
        }
        echo "</select>";
    }
    else {
        echo "Can't get parameters !";
    }

?>
