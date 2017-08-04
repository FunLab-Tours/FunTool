

<?php
/**
 * Created by PhpStorm.
 * User: thiba
 * Date: 02/08/2017
 * Time: 16:50
 */

/*
include("../include/config.php");
include("../include/module.php");
include("../include/db.php");
include("../module/machineSubFamily.php");
if(isset($_COOKIE['lang']) && file_exists("../lang/" . $_COOKIE['lang'] . ".php")){
    include("../lang/" . $_COOKIE['lang'] . ".php");
}
else{
    include("../lang/fr.php");
}

$idFamily = intval($_GET['q']);
$result = getSubFamilyList($idFamily);



echo "<select name =\"idFamily\"> <option value=\"\" selected=\"selected\"><?=".$lang['machineFamily']."?></option>";
foreach($result as $row) {
    echo "<option value=\"<?=" . $row['idFamily'] . "?>\"><?=" . $row['familyLabel'] . "?></option>";
}
echo "</select>";
*/
?>